<?php
namespace App\Repositories;
use App\Repositories\UserRepositoryInterface;
use App\User;

class UserRepository implements UserRepositoryInterface
{
    public function store($request)
    {
        return User::create($request->all());
    }
}