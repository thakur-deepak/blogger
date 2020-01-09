<?php

namespace App\Http\Middleware;

use Closure;
use App\Traits\RestExceptionHandlerTrait;


class CheckHeaders
{
    use RestExceptionHandlerTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $accept_header = $request->header('Accept');
        if ($accept_header != 'application/json') {
            return $this->invalidHeaders();
        }
//        $request->headers->set('Accept', 'application/json');
//        $request->headers->set('Content-type', 'application/json');
        return $next($request);
    }
}
