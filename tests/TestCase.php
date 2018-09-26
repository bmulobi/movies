<?php

    namespace Tests;

    use Illuminate\Foundation\Testing\DatabaseMigrations;
    use Illuminate\Foundation\Testing\DatabaseTransactions;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
    use Laravel\Passport\ClientRepository;

    abstract class TestCase extends BaseTestCase
    {
        use CreatesApplication, DatabaseMigrations;

        protected $user = [
            'name' => 'Bernard Mulobi',
            'email' => 'bernard.mulobi@andela.com',
            'password' => 'mypassword'
        ];

        protected $category = [
            'name' => 'Comedy',
            'description' => 'Hilarious laughs galore'
        ];

        protected $headers = [
            'accept' => 'application/json'
        ];

        protected $movie = [
            'title' => "Laugh Big Time",
            'description' => "Comedy of the century",
            'actors' => ['Njugush', 'Eric Omondi'],
            'url' => 'http://domain.com/laugh.jpg',
            'popularity' => 80
        ];

        protected function getApp()
        {
            return $this->createApplication();
        }

        protected function createUser(array $data)
        {
            return factory(\App\User::class)->create($data);
        }

        protected function makeUser(array $data)
        {
            return factory(\App\User::class)->make($data);
        }

        protected function createCategory(array $data)
        {
            return factory(\App\Categories::class)->create($data);
        }

        protected function makeCategory(array $data)
        {
            return factory(\App\Categories::class)->make($data);
        }

        protected function createMovie(array $data)
        {
            return factory(\App\Movies::class)->create($data);
        }

        protected function makeMovie(array $data)
        {
            return factory(\App\Movies::class)->make($data);
        }

        protected function registerUser(array $data)
        {
            return $this->post(getenv('APP_URL') . '/api/register', $data);
        }

        protected function loginUser(array $data)
        {
            $this->createUserWithPersonalAccessClient($data);
            return $this->post(getenv('APP_URL') . '/api/login', $data);
        }

        // access client necessary because of passport authentication
        protected function createUserWithPersonalAccessClient(array $data)
        {
            $data['password'] = app('hash')->make('mypassword');
            $user = $this->createUser($data);
            $clientRepository = new ClientRepository();
            $clientRepository->createPersonalAccessClient($user->id, 'test-client', getenv('APP_URL'));

            return $user;
        }

        public function getToken($data)
        {
            $response = $this->loginUser($data);
            return $response->json('token');
        }
    }
