<?php

namespace Tests\Unit\App\Http\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\CategoriesController;

class CategoriesControllerTest extends TestCase
{
    protected $app;
    protected $user;

    public function setUp()
    {
        parent::setUp();
        $this->app = $this->getApp();
        $this->user = [
            'name' => 'Bernard Mulobi',
            'email' => 'bernard.mulobi@andela.com',
            'password' => 'mypassword'
        ];

    }

    public function testCanRegisterUser() {
        $response = $this->registerUser(array_merge($this->user, ['password_confirmation' => 'mypassword']));

        $this->assertEquals(201, $response->status());
    }

    public function testCanLoginUserWithCorrectCredentials() {
        $this->createUser($this->user);
        $response = $this->loginUser(['email' => 'bernard.mulobi@andela.com', 'password' => 'mypassword']);

        $this->assertEquals(200, $response->status());
    }
}
