<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;

trait ExceptionTrait
{
    public function apiException($request, $e) {
        
        if($e instanceof ModelNotFoundException) {
            
            return response()->json([
                
                'status' => 0,
                'errors' => $e->getMessage()

            ], $e->getCode() );
            
        }
        
        if($e instanceof ValidationException) {
            $errors = $e->validator->errors();
            
            return response()->json([
                'status' => 0,
                'errors' => $errors
            ], 422 );
        }
        
        if($e instanceof HttpException) {
            
            return response()->json([
                'status' => 0,
                'errors' => $e->getMessage()
            ], $e->getCode());
        }
    }
}