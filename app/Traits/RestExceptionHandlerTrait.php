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
        $status_response['error'] = $exception->validator->errors()->getMessages();
        $status_response['message'] = 'Validation error';
        $status_response['status'] = 422;
        return response($status_response);
    }
    
    protected function MethodNotAllowedHttpException(Exception $exception)
    {
        $status_response['error'] = $exception->getMessage();
        $status_response['message'] = 'MethodNotAllowedHttpException';
        $status_response['status'] = 404;
        return response($status_response);
    }
    protected function NotFoundHttpException(Exception $exception)
    {
        $status_response['error'] = $exception->getMessage();
        $status_response['message'] = 'page not found';
        $status_response['status'] = 404;
        return response($status_response);
    }

    protected function invalidHeaders()
    {
        $status_response['error'] = 'Invalid headers';
        $status_response['message'] = 'Please set valid headers';
        $status_response['status'] = 400;
        return response($status_response);
    }
    protected function invalidToken()
    {
        $status_response['error'] = 'Invalid Token';
        $status_response['message'] = 'Please set valid token';
        $status_response['status'] = 404;
        return response($status_response);
    }

    protected function response($errors_response = '')
    {
        return response()->json(['data' => $errors_response]);
    }
}

