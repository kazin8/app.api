<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Maker;
use App\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UsersSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            User::create([
                'email' => "kazin8@gmail.com",
                'password' => Hash::make('123123')
            ]);
    }
}

