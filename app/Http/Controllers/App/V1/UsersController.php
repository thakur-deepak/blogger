<?php

namespace App\Http\Controllers\App\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    protected $user;

    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }

    public function store(UserStoreRequest $request)
    {
        $request['password'] = bcrypt($request->input('password'));
        $request['api_token'] = Str::random(60);
        $data = $this->user->store($request);
        return response()->json(['data' => $data, 'message' => 'sucess']);

    }
}
