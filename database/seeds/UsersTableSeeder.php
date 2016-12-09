<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder {

    public function run() {
        DB::table('users')->delete();

        User::create([
                'lastname' => 'XAVIER',
                'firstname' => 'Charles',
                'email'   => 'jbertrius@gmail.com',
                'password'  => bcrypt('123456'),
                'role_id'  => 2,
                'number'  => '0627875688',
                'lang'  => 'Français',
                'city'  => 'Lomé',
                'latitude'   => '6.17',
                'longitude'  => '1.23',
                'seen'  => '0',
                'valid'  => '0',
                'confirmed'  => '1',
                'confirmation_code'  => str_random(30),
                'image_path'  => '/img/icons/user.png',
                'created_at' 	  => new DateTime,
                'updated_at' 	  => new DateTime
            ]);

        User::create([
            'lastname' => 'MAXIMOFF',
            'firstname' => 'Pietro',
            'email'   => 'ezin.jean.bertrand@gmail.com',
            'password'  => bcrypt('123456'),
            'role_id'  => 2,
            'number'  => '0627875688',
            'lang'  => 'English',
            'city'  => 'Chicago',
            'latitude'   => '41.88',
            'longitude'  => '-87.63',
            'seen'  => '0',
            'valid'  => '0',
            'confirmed'  => '1',
            'confirmation_code'  => str_random(30),
            'image_path'  => '/img/icons/user.png',
            'created_at' 	  => new DateTime,
            'updated_at' 	  => new DateTime
        ]);

        User::create([
            'lastname' => 'STARK',
            'firstname' => 'Tony',
            'email'   => 'jbertrius@yahoo.com',
            'password'  => bcrypt('123456'),
            'role_id'  => 3,
            'number'  => '0627875688',
            'lang'  => 'English',
            'city'  => 'Buenos Aires',
            'latitude'   => '1.88',
            'longitude'  => '-87.63',
            'seen'  => '0',
            'valid'  => '0',
            'confirmed'  => '1',
            'confirmation_code'  => str_random(30),
            'image_path'  => '/img/icons/user.png',
            'created_at' 	  => new DateTime,
            'updated_at' 	  => new DateTime
        ]);

    }

}