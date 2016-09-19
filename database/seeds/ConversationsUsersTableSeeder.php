<?php

use Illuminate\Database\Seeder;

class ConversationsUsersTableSeeder extends Seeder {

    public function run() {


        DB::table('conversations_users')->delete();

        $user1 = DB::table('users')->where('id', '1')->first();
        $user2 = DB::table('users')->where('id', '2')->first();

        $conversation1 = DB::table('conversations')->where('author_id', $user1->id)->first(); 

        $conversations_users = array(
            array(
                'user_id' 		  => $user1->id,
                'conversation_id' => $conversation1->id
            ),
            array(
                'user_id' 		  => $user2->id,
                'conversation_id' => $conversation1->id
            ) 
        );

        DB::table('conversations_users')->insert($conversations_users);

    }

}