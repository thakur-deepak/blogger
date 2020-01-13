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
        $result['error'] = $exception->validator->errors()->getMessages();
        $result['message'] = 'Validation error';
        $result['status'] = 422;
        return response($result);
    }
    
    protected function MethodNotAllowedHttpException(Exception $exception)
    {
        $result['error'] = $exception->getMessage();
        $result['message'] = 'MethodNotAllowedHttpException';
        $result['status'] = 404;
        return response($result);
    }
    protected function NotFoundHttpException(Exception $exception)
    {
        $result['error'] = $exception->getMessage();
        $result['message'] = 'page not found';
        $result['status'] = 404;
        return response($result);
    }

    protected function invalidHeaders()
    {
        $result['error'] = 'Invalid headers';
        $result['message'] = 'Please set valid headers';
        $result['status'] = 400;
        return response($result);
    }
    protected function invalidToken()
    {
        $result['error'] = 'Invalid Token';
        $result['message'] = 'Please set valid token';
        $result['status'] = 404;
        return response($result);
    }

    protected function response($errors_response = '')
    {
        return response()->json(['data' => $errors_response]);
    }
}

