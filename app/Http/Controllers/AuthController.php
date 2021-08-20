<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $authService;

    public function __construct(AuthService $authService){

        $this->authService = $authService;
    }

    public function login(AuthLoginRequest $request){

        $input = $request->validated();
       

        $token = $this->authService->login($input['email'], $input['password']);

        return (new UserResource(auth()->user()))->additional( $token);
      
    }

    public function register(AuthRegisterRequest $request){
        
        $input = $request->validated();

        $user = $this->authService->register($input['name'], $input['cnpj'], $input['email'], $input['password'],);

        return  new UserResource($user);

    }

    public function teste(){
       return 'sdasdasdasd';
    }
}
