<?php

namespace App\Traits;

use Exception;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait RestExceptionHandlerTrait {

    protected function getJsonResponseForException(Exception $exception)
    {
        switch(true)
        {
            case ($exception instanceof ValidationException):
                return $this->validationException($exception);
            case ($exception instanceof MethodNotAllowedHttpException):
                return $this->MethodNotAllowedHttpException($exception);
            case ($exception instanceof NotFoundHttpException):
                return $this->NotFoundHttpException($exception);
        }
    }
    
    protected function validationException(ValidationException $exception) {
        $response['error'] = $exception->validator->errors()->getMessages();
        $response['message'] = 'Validation error';
        $response['status'] = 422;
        return response($response);        
    }
    
    protected function MethodNotAllowedHttpException(Exception $exception)
    {
        $response['error'] = $exception->getMessage();
        $response['message'] = 'MethodNotAllowedHttpException';
        $response['status'] = 404;
        return response($response);
    }
    protected function NotFoundHttpException(Exception $exception)
    {
        $response['error'] = 'Not found';
        $response['message'] = 'page not found';
        $response['status'] = 404;
        return response($response);
    }

    protected function response($errors_response = '')
    {
        return response()->json(['data' => $errors_response]);
    }
}

