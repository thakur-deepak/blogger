<?php
namespace App\Repositories;
use App\Repositories\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    private $user;
    
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    
    public function store($request)
    {
        return $this->user->create($request->all());
    }

    public function get()
    {
        return $this->user->get();
    }
}