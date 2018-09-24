<?php

namespace Tests;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseMigrations;

    protected function getApp() {
        return $this->createApplication();
    }

    protected function createUser(array $data) {
        return factory(\App\User::class)->create($data);
    }

    protected function makeUser(array $data) {
        return factory(\App\User::class)->make($data);
    }

    protected function createCategory(array $data) {
        return factory(\App\Categories::class)->create($data);
    }

    protected function makeCategory(array $data) {
        return factory(\App\Categories::class)->make($data);
    }

    protected function createMovie(array $data) {
        return factory(\App\Movies::class)->create($data);
    }

    protected function makeMovie(array $data) {
        return factory(\App\Movies::class)->make($data);
    }

    protected function registerUser(array $data) {
        return $this->post(getenv('APP_URL') . ':8000/api/register', $data);
    }

    protected function loginUser(array $data) {
        return $this->post(getenv('APP_URL') . ':8000/api/login', $data);
    }
}
