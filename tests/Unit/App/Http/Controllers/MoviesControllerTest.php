<?php

namespace Tests\Unit\App\Http\Controllers;;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MoviesControllerTest extends TestCase
{
    protected $app;

    public function setUp()
    {
        parent::setUp();
        $this->app = $this->getApp();

        $this->registerUser($this->user);
        $token = $this->getToken($this->user);
        $this->headers = array_merge($this->headers, ['Authorization' => "Bearer $token"]);
    }

    public function testCanCreateMovie() {
        $this->post(
            getenv('APP_URL') . '/api/category',
            $this->category,
            $this->headers
        );

        $this->post(
            getenv('APP_URL') . '/api/movie',
            array_merge($this->movie, ['category' => $this->category['name']]),
            $this->headers
        )->assertStatus(201);
    }

    public function testCanGetAllMovies() {
        $category = $this->createCategory($this->category);
        $this->createMovie(array_merge($this->movie, ['category' => $category['id']]));

        $category = $this->createCategory([
            'name' => 'Action Packed',
            'description' => 'Kungfu et al'
        ]);
        $this->createMovie([
            'title' => "Movie 2",
            'description' => "Great Movie",
            'actors' => ['Jackie Chan', 'Rambo'],
            'url' => 'http://domain.com/kungfu.jpg',
            'popularity' => 90,
            'category' => $category['id']
        ]);

        $response = $this->get(
            getenv('APP_URL') . '/api/movies',
            $this->headers
        );

        $response->assertOk();
        $response->assertJsonCount(2, 'movies');
    }
}
