<?php

namespace App\Traits;

use Exception;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait RestExceptionHandlerTrait {

    private $response = [];
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
        $this->response['error'] = $exception->validator->errors()->getMessages();
        $this->response['message'] = 'Validation error';
        $this->response['status'] = 422;
        return response($this->response);
    }
    
    protected function MethodNotAllowedHttpException(Exception $exception)
    {
        $this->response['error'] = $exception->getMessage();
        $this->response['message'] = 'MethodNotAllowedHttpException';
        $this->response['status'] = 404;
        return response($this->response);
    }
    protected function NotFoundHttpException(Exception $exception)
    {
        $this->response['error'] = $exception->getMessage();
        $this->response['message'] = 'page not found';
        $this->response['status'] = 404;
        return response($this->response);
    }

    protected function invalidHeaders()
    {
        $this->response['error'] = 'Invalid headers';
        $this->response['message'] = 'Please set valid headers';
        $this->response['status'] = 400;
        return response($this->response);
    }
    protected function invalidToken()
    {
        $this->response['error'] = 'Invalid Token';
        $this->response['message'] = 'Please set valid token';
        $this->response['status'] = 404;
        return response($this->response);
    }

    protected function response($errors_response = '')
    {
        return response()->json(['data' => $errors_response]);
    }
}

