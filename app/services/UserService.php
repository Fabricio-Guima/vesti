<?php

namespace App\Services;

use App\Classes\Logger;
use App\Exceptions\UserHasBeenTakenException;
use App\Models\User;
use Illuminate\Support\Str;


class UserService {

	private $logger;

	public function __construct()
	{
		$this->logger = new Logger();
		
	}
	
	public function update(User $user,array $input){


		//rode o último where que retira o meu email atual da lista e envia essa lista para o primeiro where onde e aqui eu vejo se meu imnput[email] existe e com certeza não existe, mas se existir isso vira é verdadeiro e caio na exception

		$checkUserEmail = User::where('email', $input['email'])->where('email','!=' ,$user->email)->exists();

		if(!empty($input['email'] && $checkUserEmail)){

			throw new UserHasBeenTakenException();

		}
		
		if(!empty($input['password'])){
			$input['password'] = bcrypt($input['password']);
		}

		// funciona como o create e vc só usa o fill quando vc tiver uma instancia do seu model já criada e ele aceita um array
		$user->fill($input);
		$user->save();

		//log
		$this->logger->log('info', 'Fez atualização de perfil.');

		//garanto que as infos virão atualizadas
		return $user->fresh();

	}
}