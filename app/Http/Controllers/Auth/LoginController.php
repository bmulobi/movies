<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    use \App\Http\Controllers\ErrorHandler;
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // API login
    public function login(Request $request) {
        try {
            $credentials = $this->validate($request, ['email' => 'required|email', 'password' => 'required|string']);

            $user = User::whereEmail($credentials['email'])->first();

            if (!is_null($user) && Hash::check($credentials['password'], $user->password)) {
                $token = $user->createToken('access-token')->accessToken;
                return \response([
                    'message' => "Login was successful",
                    'token' => $token
                ], Response::HTTP_OK);
            } else {
                return \response(['error' => 'Wrong credentials'], Response::HTTP_UNAUTHORIZED);
            }
        } catch (ValidationException $e) {
            return $this->getError($e, Response::HTTP_BAD_REQUEST);
        } catch (\PDOException $e) {
            return $this->getError($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (\Exception $e) {
            return $this->getError($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
