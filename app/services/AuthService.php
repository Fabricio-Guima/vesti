<?php

namespace App\Services;

use App\Exceptions\LoginInvalidException;
use App\Exceptions\UserHasBeenTakenException;
use App\Models\User;

class AuthService {

	public function login(string $email, string $password){

		$login = [
			'email' => $email,
			'password' => $password,

		];

		if(!$token = auth()->attempt($login) ){

			throw new LoginInvalidException();

		}

		return [
			'token' => $token,
			'token_type' => 'Bearer'
		];

	}

	public function register(string $name, string $cnpj, string $email, string $password) {

		$user = User::where('email', $email)->exists();

		if(!empty($user)) {
			throw new UserHasBeenTakenException();
		}

		$userPassword = bcrypt($password);

		$user = User::create([
			'name' => $name,
			'cnpj' => $cnpj,
			'email' => $email,
			'password' => $userPassword,
		]);

		return $user;

		
	}

}