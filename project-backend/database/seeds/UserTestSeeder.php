<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('users')->insert([
            ['name' => "test1",'phone' => "000-000-000",'address' => 'akjbdfkasd','email' => 'test@gmail.com','password' => Hash::make('123456'),'role' => 'admin'],
            ['name' => "test2",'phone' => "000-000-000",'address' => 'akjbdfkasd','email' => 'test26541@gmail.com','password' => Hash::make('123456'),'role' => 'user'],
            ['name' => "test3",'phone' => "000-000-000",'address' => 'akjbdfkasd','email' => 'test653@gmail.com','password' => Hash::make('123456'),'role' => 'admin'],
            ['name' => "test4",'phone' => "000-000-000",'address' => 'akjbdfkasd','email' => 'test45@gmail.com','password' => Hash::make('123456'),'role' => 'user'],
        ]);
    }
}
