<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

      DB::table('users')->insert([
        [
          'name'=>'admin'	,
          'email'=>'admin@gmail.com',
          'password'=>bcrypt('1234'),
          'role'=>'admin',

          'status'=>'approve',

        ],
        [
          'name'=>'shaza'	,
          'email'=>'shaza@gmail.com',
          'password'=>bcrypt('1234'),
          'role'=>'user',

          'status'=>'approve',
        ],
        [
          'name'=>'sobhi'	,
          'email'=>'sobhi@gmail.com',
          'password'=>bcrypt('1234'),
          'role'=>'user',

          'status'=>'approve',
        ],

      ]);

  DB::table('user_groups')->insert([
    [
'user_id'=>1,
'group_id'=>1,
],

[
'user_id'=>1,
'group_id'=>2,
],
[
'user_id'=>2,
'group_id'=>1,
],
[
'user_id'=>3,
'group_id'=>2,
],



      ]);

    }
}
