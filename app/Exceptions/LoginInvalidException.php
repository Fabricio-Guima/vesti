<?php

namespace App\Exceptions;

use Exception;

class LoginInvalidException extends Exception
{
    protected $message = 'E-mail and password don\'t match';
    public function render(){

        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage()
        ], status: 401);
    }
}
