<?php

namespace Tests\Feature;

use Crypt;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class GeneralTest extends TestCase
{

    protected string $get_url = '/api/history';
    protected string $create_url = '/api/history/store';

    public function test_home_page(): void
    {
        $response = $this->get('/')
            ->assertStatus(200);

        $cookie_value = $response->getCookie('client_key')->getValue();

        $decryptedClientKey = Crypt::decrypt($cookie_value, false);
        $client_key = explode('|', $decryptedClientKey);

        $this->assertTrue(Uuid::isValid($client_key[1]));
    }

    public function test_get_client_history(): void
    {
        $this->get($this->get_url)
            ->assertStatus(404);

        $this->get($this->get_url . '/5')
            ->assertStatus(302);

        $this->get($this->get_url . '/5?client_key=test')
            ->assertStatus(302);

        $uuid = Uuid::uuid4();
        $this->get($this->get_url . '/5?client_key=' . $uuid)
            ->assertStatus(200)
            ->assertExactJson([
                'status' => 'success',
                'histories' => []
            ]);
    }

    public function test_create_client_history(): void
    {
        $data = [
            'client_key' => Uuid::uuid4(),
            'value' => '123+123=246'
        ];

        // Check post
        $this->json('POST', $this->create_url, $data)
            ->assertStatus(200)
            ->assertExactJson([
                'status' => 'success'
            ]);

        $this->json('POST', $this->create_url)
            ->assertStatus(422)
            ->assertJsonPath('status', 'error');


        // Check get
        $this->get($this->create_url)
            ->assertStatus(302);

        $this->json('GET', $this->create_url, $data)
            ->assertStatus(500);

        // Wrong data
        $data['client_key'] = '';
        $this->json('POST', $this->create_url, $data)
            ->assertStatus(422)
            ->assertJsonValidationErrors('client_key');
    }

    public function test_client_full_case(): void
    {
        $data = [
            'client_key' => Uuid::uuid4(),
            'value' => '123+123=246'
        ];

        // Check create
        $this->json('POST', $this->create_url, $data)
            ->assertStatus(200)
            ->assertExactJson([
                'status' => 'success'
            ]);

        // Check receive
        $this->json('GET', $this->get_url.'/5?client_key='.$data['client_key'])
            ->assertStatus(200)
            ->assertExactJson([
                'status' => 'success',
                'histories' => [
                    $data['value']
                ]
            ]);

        $uuid = Uuid::uuid4();
        $this->json('GET', $this->get_url.'/5?client_key='.$uuid)
            ->assertStatus(200)
            ->assertExactJson([
                'status' => 'success',
                'histories' => []
            ]);
    }
}
