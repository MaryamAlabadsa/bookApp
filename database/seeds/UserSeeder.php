<?php

use App\User;

class UserSeeder
{
    public function run()
    {
        factory(App\User::class, 50)->create()->each(function ($user) {
            $user->posts()->save(factory(App\User::class)->make());
        });
    }
}
