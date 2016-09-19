<?php

use Illuminate\Database\Seeder;


class ConversationsTableSeeder extends Seeder {

    public function run() {

        DB::table('conversations')->delete();

        $user1 = DB::table('users')->where('id', '1')->first();
        

        $conversations = array(
            array(
                'created_at' => new DateTime,
                'name' 		 => str_random(30),
                'author_id'  => $user1->id
            )
        );

        DB::table('conversations')->insert($conversations);

    }
}