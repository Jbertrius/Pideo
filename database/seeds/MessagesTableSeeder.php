<?php

use Illuminate\Database\Seeder;

class MessagesTableSeeder extends Seeder {

    public function run() {

        DB::table('messages')->delete();

        $user1 = DB::table('users')->where('id', '1')->first();
        $user2 = DB::table('users')->where('id', '2')->first();

        $conversation1 = DB::table('conversations')->where('author_id', $user1->id)->first(); 

        $messages = array(
            array(
                'created_at'	  => new DateTime,
                'body' 			  => 'Jesse!',
                'type'              =>  'text',
                'conversation_id' => $conversation1->id,
                'user_id'		  => $user1->id
            ),
            array(
                'created_at'	  => new DateTime,
                'body' 			  => 'Yo, bitch!',
                'type'              =>  'text',
                'conversation_id' => $conversation1->id,
                'user_id'		  => $user2->id
            ),   
            array(
                'created_at'	  => new DateTime,
                'body' 			  => 'Fuck you!',
                'type'              =>  'text',
                'conversation_id' => $conversation1->id,
                'user_id'		  => $user1->id
            )
        );

        DB::table('messages')->insert($messages);

    }

}