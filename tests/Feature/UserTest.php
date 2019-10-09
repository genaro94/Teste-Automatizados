<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\UserProfile;

class UserTest extends TestCase
{

    use DatabaseMigrations;

    public function test_create_user(){
        User::create([
            'name'      => 'Admin User',
            'email'     => 'admin@emai.com',
            'password'  => bcrypt(123456)
        ]);

        $this->assertDatabaseHas('users', ['name' => 'Admin User']);
    }

    public function test_create_user_profile(){
        $user = User::create([
            'name'      => 'Admin User',
            'email'     => 'admin@emai.com',
            'password'  => bcrypt(123456)
        ]);

        $user_profile = UserProfile::create([
            'user_id'   => $user->id,
            'address'   => '42 Road St',
            'state'     => 'FL',
            'zip'       => '32432'
        ]);
        $this->assertDatabaseHas('users', ['name' => 'Admin User']);
        $this->assertDatabaseHas('user_profiles',
                ['user_id' => $user->id,
                'address'   => '42 Road St'
        ]);
    }

    public function test_get_profile_by_user(){
        $user = User::create([
            'name'      => 'Admin User',
            'email'     => 'admin@emai.com',
            'password'  => bcrypt(123456)
        ]);

        UserProfile::create([
            'user_id'   => $user->id,
            'address'   => '42 Road St',
            'state'     => 'FL',
            'zip'       => '32432'
        ]);
        $profile = UserProfile::find(1);
        $result = $user->profile;
        $this->assertEquals($profile, $result);
    }
}
