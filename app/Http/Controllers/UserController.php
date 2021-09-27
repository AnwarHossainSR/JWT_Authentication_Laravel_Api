<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\RegistrationFormRequest;
use App\Traits\ApiResponseWithHttpStatus;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    use ApiResponseWithHttpStatus;

    public function  __construct()
    {
        Auth::shouldUse('users');
    }

    public function register(RegistrationFormRequest $request)
    {


        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        $credentials = $request->only('email', 'password');

        $token = JWTAuth::attempt($credentials);

        $data = ['access_token' => $token, 'user' => Auth::user()];

        return $this->apiResponse('Registration Success', $data, Response::HTTP_OK, true);
    }

    public  function login(LoginFormRequest $request)
    {

        $input = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($input)) {
            return $this->apiResponse('Invalid credential', null, Response::HTTP_BAD_REQUEST, false);
        }

        $data = ['access_token' => $token, 'user' => Auth::user()];

        return $this->apiResponse('Success Login', $data, Response::HTTP_OK, true);
    }

    public  function logout()
    {
        if (Auth::check()) {
            $token = Auth::getToken();
            JWTAuth::setToken($token);
            JWTAuth::invalidate();
            Auth::logout();
            return $this->apiResponse('Logout Success', null, Response::HTTP_OK, true);
        } else {
            return $this->apiResponse('Logout Error', null, Response::HTTP_UNAUTHORIZED, false);
        }
    }

    public function authenticatedUser()
    {
        return $this->apiResponse('Authenticated !', Auth::user(), Response::HTTP_OK, true);
    }
}
