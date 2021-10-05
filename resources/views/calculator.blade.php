<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
</head>
<body>

    <div id="app">
        <div class="calculator">
            <div class="results">
                <input class="input" v-model="current">
            </div>

            <div class="numbers">
                <button class="button" v-on:click="pressNumber">7</button>
                <button class="button" v-on:click="pressNumber">8</button>
                <button class="button" v-on:click="pressNumber">9</button>
                <button class="button" v-on:click="pressNumber">4</button>
                <button class="button" v-on:click="pressNumber">5</button>
                <button class="button" v-on:click="pressNumber">6</button>
                <button class="button" v-on:click="pressNumber">1</button>
                <button class="button" v-on:click="pressNumber">2</button>
                <button class="button" v-on:click="pressNumber">3</button>
            </div>

            <div class="clear-operator">
                <button class="button" v-on:click="pressClear">C</button>
            </div>

            <div class="operators">
                <button class="button" v-on:click="pressMultiply">*</button>
                <button class="button" v-on:click="pressDivide">/</button>
                <button class="button" v-on:click="pressPlus">+</button>
                <button class="button" v-on:click="pressMinus">-</button>
                <button class="button equal-sign" v-on:click="pressEquals">=</button>
            </div>
        </div>

        <div class="list">
            <h2>Last your results</h2>

            <ul class="histories">
                <li class="left clearfix" v-for="history in histories">@{{ history }}</li>
            </ul>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
