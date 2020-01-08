<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use WithFaker, RefreshDatabase;
    private $api_path;
    
    public function setUp() :void
    {        
         parent::setUp();
         $this->api_path = config('constants.API_PATH');
    }
    
    public function testCreate()
    {
        $this->withoutExceptionHandling();
        $attributes = [
            'name' => $this->faker->firstName(),
            'email' => $this->faker->email(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
        ];
        $this->post($this->api_path. 'users', $attributes);

        $this->assertDatabaseHas('users', $attributes);
    }
}