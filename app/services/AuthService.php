<?php

namespace App\Services;

use App\Classes\Logger;
use App\Exceptions\LoginInvalidException;
use App\Exceptions\UserHasBeenTakenException;
use App\Models\User;


class AuthService {

	private $logger;

	public function __construct()
	{
		$this->logger = new Logger();
		
	}

	public function login(string $email, string $password){

		$login = [
			'email' => $email,
			'password' => $password,

		];

		if(!$token = auth()->attempt($login) ){

			throw new LoginInvalidException();

		}

		//log
		$this->logger->log('info', 'Fez o seu login.');

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

		//log
		$this->logger->log('info', 'Fez o seu registro.');

		return $user;

		
	}

}