<?php

namespace App\Http\Controllers\App\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;


class UsersController extends Controller
{
    protected $user;

    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }

    public function store(Request $request)
    {
        if ($this->user->store($request)) {
            return response()->json(['data' =>  'Data saved sucessfully', 'success' => true]);
        }
        return response()->json(['data' =>  'Data not saved', 'success' => false]);
    }

    public function get()
    {
        $users = $this->user->get();
        if ($users) {
            return response()->json(['data' =>  $users, 'success' => true]);
        }
        return response()->json(['data' =>  'Data not available', 'success' => false]);
    }
}
