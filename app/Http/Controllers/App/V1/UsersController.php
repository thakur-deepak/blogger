<?php

namespace App\Http\Controllers\App\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Repositories\UserRepositoryInterface;


class UsersController extends Controller
{
    protected $user;

    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }

    public function store(UserStoreRequest $request)
    {
        if ($this->user->store($request)) {
            return response()->json(['data' =>  'Data saved sucessfully', 'success' => true]);
        }
        return response()->json(['data' =>  'Data not saved', 'success' => false]);
    }
}
