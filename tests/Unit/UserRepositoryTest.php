<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;

class UserRepositoryTest extends TestCase
{
    use WithFaker, RefreshDatabase;
    private $user;
    public function setUp() :void
    {        
        parent::setUp();         
        $this->model = Mockery::mock('App\User');
        $this->user = new UserRepository($this->model);
         
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    /*public function testCreate()
    {
        // $this->withoutExceptionHandling();
        $request = [
            'name' =>  'dfsf',
            'email' => 'email@gmail.com',
            'password' =>  '1212dsdsfdsf'
        ];
        $user_data = $this->user->store($request);
    }*/
}
