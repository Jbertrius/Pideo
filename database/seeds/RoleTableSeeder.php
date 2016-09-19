<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleTableSeeder extends Seeder {

    public function run() {
        DB::table('roles')->delete();
        Role::create([
            'title' => 'Administrator',
            'slug' => 'admin'
        ]);


        Role::create([
            'title' => 'User',
            'slug' => 'user'
        ]);
    }

}