<?php

namespace App\Exceptions;

use Exception;

class addphotoMaxQuantityException extends Exception
{
    protected $message = 'Cannot add more photos';
    public function render(){

        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage()
        ], status: 401);
    }
}
