<?php

namespace App\Traits;

use Exception;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait RestExceptionHandlerTrait
{
    protected function getJsonResponseForException(Exception $exception)
    {
        switch(true)
        {
            case ($exception instanceof ValidationException):
                return $this->validation($exception);
            case ($exception instanceof MethodNotAllowedHttpException):
                return $this->MethodNotAllowedHttp($exception);
            case ($exception instanceof NotFoundHttpException):
                return $this->NotFoundHttp($exception);
        }
    }

    protected function validation(ValidationException $exception) {
        return $this->response('Validation error', 422, $exception->validator->errors()->getMessages());
    }

    protected function MethodNotAllowedHttp(Exception $exception)
    {
        return $this->response('Method not allowed', 404, $exception->getMessage());
    }

    protected function NotFoundHttp(Exception $exception)
    {
        return $this->response('Not found', 400, $exception->getMessage());
    }

    protected function invalidHeaders()
    {
        return $this->response('Invalid headers', 400);
    }
    protected function invalidToken()
    {
        return $this->response('Invalid Token', 404);
    }

    protected function response($message, $status, $data = '', $success = false)
    {
        return response()->json(array(
            'message' => $message,
            'success' => $success,
            'status' => $status,
            'data' => $data,
        ));
    }
}

