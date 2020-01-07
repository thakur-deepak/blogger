<?php

namespace App\Traits;

use Exception;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

trait RestExceptionHandlerTrait {

    protected function getJsonResponseForException(Exception $exception)
    {
        switch(true)
        {
            case ($exception instanceof ValidationException):
                return $this->validationException($exception);
            case ($exception instanceof MethodNotAllowedHttpException):
                return $this->MethodNotAllowedHttpException($exception);
        }
    }
    
    protected function validationException(ValidationException $exception) {
        $errors_response['error'] = $exception->validator->errors()->getMessages();
        $errors_response['message'] = 'Validation error';
        $errors_response['status'] = 422;
        return response($errors_response);
        
    }
    protected function MethodNotAllowedHttpException($exception)
    {
        $errors_response['error'] = $exception->getMessage();
        $errors_response['message'] = 'MethodNotAllowedHttpException';
        $errors_response['status'] = 404;
        return response($errors_response);
    }

    protected function response($errors_response = '')
    {
        return response()->json(['data' => $errors_response]);
    }
}

