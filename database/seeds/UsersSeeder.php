<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
               'name'=>'Muhammad Arif Faizin',
               'email'=>'muhammadariffaizin@gmail.com',
               'is_admin'=>'1',
               'password'=> bcrypt('1234567'),
            ],
            [
               'name'=>'User',
               'email'=>'user@gmail.com',
               'is_admin'=>'0',
               'password'=> bcrypt('123456'),
            ],
        ];
  
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
