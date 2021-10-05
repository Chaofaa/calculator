require('./bootstrap');

import Vue from 'vue/dist/vue.js';

const app = new Vue({
    el: '#app',

    data: {
        current: '',
        histories: [],
        max_histories: 5,
    },

    created() {
        this.getHistories()
    },

    methods: {
        pressNumber: function(event) {
            let key = event.target.innerText;
            app.current += key;
        },
        pressEquals: function () {
            if (app.current !== '') {

                const input = app.current;

                if ((app.current).indexOf("^") > -1) {
                    const base = (app.current).slice(0, (app.current).indexOf("^"));
                    const exponent = (app.current).slice((app.current).indexOf("^") + 1);
                    app.current = eval("Math.pow(" + base + "," + exponent + ")").toString();
                } else {
                    app.current = eval(app.current).toString();
                }

                this.storeValue(input + '=' + app.current);
            }
        },
        pressClear: function () {
            app.current = "";
        },
        pressMultiply: function () {
            app.current += "*";
        },
        pressDivide: function () {
            app.current +=  "/";
        },
        pressPlus: function () {
            app.current +=  "+";
        },
        pressMinus: function () {
            app.current +=  "-";
        },
        storeValue(value) {
            if (this.histories.length >= this.max_histories) this.histories.pop();
            this.histories.unshift(value);

            axios.post('/api/history/store', {
                key: 'test',
                value: value
            }).then(response => {
                if (response.data.status === 'error') {
                    alert('can\'t save');
                }
            });
        },
        getHistories() {
            axios.get('/api/history/' + this.max_histories,).then(response => {
                if (response.data.status === 'success') {
                    this.histories = response.data.histories;
                } else {
                    alert('error');
                }
            });
        }
    }
});
