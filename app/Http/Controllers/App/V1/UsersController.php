<?php

namespace App\Http\Controllers\App\V1;

use App\Http\Controllers\Controller;

use App\Repositories\UserRepositoryInterface;
use App\Http\Requests\UserStoreRequest;
class UsersController extends Controller
{
    protected $user;

    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }
    
    public function store(UserStoreRequest $request)
    {     
       return $this->user->store($request);
    }
}
