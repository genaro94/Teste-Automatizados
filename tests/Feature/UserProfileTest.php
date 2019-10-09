<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Services\UserServices;

class UserProfileTest extends TestCase
{
    use DatabaseMigrations;

   public function test_create_user_and_profile_with_service(){
       $data = [
           'name'     => 'Admin User',
           'email'    => 'admin@email.com',
           'password' => '123',
           'address'  => '123 Eliot St',
           'state'    => 'FL',
           'zip'      =>  '301232'
       ];

       $userService = new UserServices();
       $user = $userService->create($data);

       $excepted = User::find(1);

       $this->assertEquals($excepted->id, $user);
   }
}
