<?php

namespace App\Http\Controllers;

use App\Classes\Logger;
use App\Http\Requests\MeUpdateRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;

class MeController extends Controller
{
    private $logger;

	public function __construct()
	{
		$this->logger = new Logger();		
		
	}

    public function index(){

        //log
		$this->logger->log('info', 'Acessou suas informações de perfil.');
        
        return new  UserResource(auth()->user());
    }

    public function update(MeUpdateRequest $request){

        $input = $request->validated();
        
        $user = (new UserService())->update(auth()->user(), $input);

        //log
		$this->logger->log('info', 'Atualizou suas informações de perfil.');

        return new UserResource($user);
    }
}
