<?php

namespace App\Classes;

use Illuminate\Support\Facades\Log;

class Logger {

	public function log($level, $message){

		//adicionar a identificacao do usuário ativo na mensagem
		if(auth()->user()) {

			$message = auth()->user() . ' - ' . $message;
		} else {
			$message = '[N/A] ' . ' - ' . $message;
		}

		Log::channel('main')->$level($message);

	}



}