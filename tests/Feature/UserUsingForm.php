<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class UserUsingForm extends TestCase
{
    use DatabaseMigrations;

    public function test_create_user_using_form(){

        $this->visit('/')->see("Register")
            ->click("Register")
            ->type('Admin User', 'name')
            ->type('admin@email.com', 'email')
            ->type('123', 'password')
            ->type('123', 'password_confirmation')
            ->press('Register');

        $this->assertDatabaseHas('users', ['name' => 'Admin User']);
    }
}
