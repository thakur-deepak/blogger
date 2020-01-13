<?php

namespace App\Traits;

use Exception;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait RestExceptionHandlerTrait {

    private $status_response = [];
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
        $this->status_response['error'] = $exception->validator->errors()->getMessages();
        $this->status_response['message'] = 'Validation error';
        $this->status_response['status'] = 422;
        return response($this->status_response);
    }
    
    protected function MethodNotAllowedHttpException(Exception $exception)
    {
        $this->status_response['error'] = $exception->getMessage();
        $this->status_response['message'] = 'MethodNotAllowedHttpException';
        $this->status_response['status'] = 404;
        return response($this->status_response);
    }
    protected function NotFoundHttpException(Exception $exception)
    {
        $this->status_response['error'] = $exception->getMessage();
        $this->status_response['message'] = 'page not found';
        $this->status_response['status'] = 404;
        return response($this->status_response);
    }

    protected function invalidHeaders()
    {
        $this->status_response['error'] = 'Invalid headers';
        $this->status_response['message'] = 'Please set valid headers';
        $this->status_response['status'] = 400;
        return response($this->status_response);
    }
    protected function invalidToken()
    {
        $this->status_response['error'] = 'Invalid Token';
        $this->status_response['message'] = 'Please set valid token';
        $this->status_response['status'] = 404;
        return response($this->status_response);
    }

    protected function response($errors_response = '')
    {
        return response()->json(['data' => $errors_response]);
    }
}

