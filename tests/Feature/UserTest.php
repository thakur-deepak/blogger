<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

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
            'first_name' =>  $this->faker->firstName(),
            'last_name' =>  $this->faker->lastName(),
            'email' => $this->faker->email(),
            'password' =>  $this->faker->password()
        ];
        $this->post($this->api_path. 'users', $attributes)
            ->assertStatus(200)
            ->assertSee('data')
            ->assertSee('Data saved sucessfully')
            ->assertSee('success')
            ->assertSee('true');
    }
}