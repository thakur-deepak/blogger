<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class UserTest extends TestCase
{
    use WithFaker, RefreshDatabase;
    private $api_path;
    private $user;
    protected $json_headers = ['Accept' => 'application/json'];
    
    public function setUp() :void
    {        
         parent::setUp();
         $this->api_path = config('constants.API_PATH');
         $this->user = factory(User::class)->create();
    }
    
    public function testCreate()
    {
        $attributes = [
            'name' =>  $this->faker->name(),
            'email' => $this->faker->email(),
            'password' =>  $this->faker->password()
        ];
        $this->post($this->api_path. 'users', $attributes)
            ->assertStatus(200)
            ->assertSee('sucess');
    }
}