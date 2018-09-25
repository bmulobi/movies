<?php

namespace Tests\Unit\App\Http\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoriesControllerTest extends TestCase
{
    protected $app;
    protected $user;
    protected $category;
    protected $headers;
    protected $movie;

    public function setUp()
    {
        parent::setUp();
        $this->app = $this->getApp();
        $this->user = [
            'name' => 'Bernard Mulobi',
            'email' => 'bernard.mulobi@andela.com',
            'password' => 'mypassword'
        ];

        $this->category = [
            'name' => 'Comedy',
            'description' => 'Hilarious laughs galore'
        ];

        $this->headers = [
            'accept' =>'application/json'
        ];

        $this->movie = [
            'title' => "Laugh Big Time",
            'description' => "Comedy of the century",
            'actors' => ['Njugush', 'Eric Omondi'],
            'url' => 'http://domain.com/laugh.jpg',
            'popularity' => 80,
            'category' =>$this->category['name']
        ];

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

    public function testCanCreateMovie() {
        $token = $this->getToken($this->user);
        $headers = array_merge($this->headers, ['Authorization' => "Bearer $token"]);

        $this->post(
            getenv('APP_URL') . ':8000/api/category',
            $this->category,
            $headers
        );

        $this->post(
            getenv('APP_URL') . ':8000/api/movie',
            $this->movie,
            $headers
        )->assertStatus(201);
    }
}
