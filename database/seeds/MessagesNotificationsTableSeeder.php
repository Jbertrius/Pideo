<?php

use Illuminate\Database\Seeder;

class MessagesNotificationsTableSeeder extends Seeder {

    public function run() {
        DB::table('messages_notifications')->delete();

        $user1 = DB::table('users')->where('id', '1')->first();
        $user2 = DB::table('users')->where('id', '2')->first();

        $message1 = DB::table('messages')->where('body', 'Jesse!')->first();
        $message2 = DB::table('messages')->where('body', 'Yo, bitch!')->first();
        $message5 = DB::table('messages')->where('body',  'Fuck you!')->first();

        $messages_notifications = array(
            array(
                'user_id'    	  => $user2->id,
                'message_id' 	  => $message1->id,
                'conversation_id' => $message1->conversation_id,
                'read'		 	  => true,
                'created_at' 	  => new DateTime,
                'updated_at' 	  => new DateTime,
            ),
            array(
                'user_id'    	  => $user1->id,
                'message_id'      => $message2->id,
                'conversation_id' => $message2->conversation_id,
                'read'		 	  => true,
                'created_at' 	  => new DateTime,
                'updated_at' 	  => new DateTime,
            ),
            array(
                'user_id'         => $user1->id,
                'message_id' 	  => $message5->id,
                'conversation_id' => $message5->conversation_id,
                'read'		 	  => true,
                'created_at' 	  => new DateTime,
                'updated_at' 	  => new DateTime,
            )
        );

        DB::table('messages_notifications')->insert($messages_notifications);
    }

}