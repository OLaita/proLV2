<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Roles;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $role_user = Roles::where('rol', 'user')->first();
        $role_admin = Roles::where('rol', 'admin')->first();
        //dd($role_admin);

        $user = new User();
        $user->name = 'user1';
        $user->email = 'user@example.com';
        $user->password = bcrypt('user1');
        $user->rol_id = 2;
        $user->save();
        $user->roles()->attach($role_user);


        $user = new User();
        $user->name = 'Admin';
        $user->email = 'admin@example.com';
        $user->password = bcrypt('secret');
        $user->rol_id = 1;
        $user->save();
        $user->roles()->attach($role_admin);

    }
}
