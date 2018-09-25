<?php

namespace Tests\Unit\App\Http\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoriesControllerTest extends TestCase
{
    protected $app;

    public function setUp()
    {
        parent::setUp();
        $this->app = $this->getApp();
    }

    public function testCanRegisterUser() {
        $response = $this->registerUser(
            array_merge($this->user, ['password_confirmation' => 'mypassword'])
        );

        $this->assertEquals(201, $response->status());
    }

    public function testCanLoginUserWithCorrectCredentials() {
        $this->loginUser($this->user)->assertOk();
    }

    public function testCannotLoginWithWrongCredentials() {
        $this->loginUser(
            ['name' => 'Bernard Mulobi', 'email' => 'bernard.mulobi@andela.com', 'password' => 'fakePassword']
        )->assertStatus(401);
    }

    public function testCanCreateCategory() {
        $token = $this->getToken($this->user);

        $this->post(
            getenv('APP_URL') . ':8000/api/category',
            $this->category,
            array_merge($this->headers, ['Authorization' => "Bearer $token"])
            )->assertStatus(201);
    }
}
