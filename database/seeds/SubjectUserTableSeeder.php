<?php

use Illuminate\Database\Seeder;
use App\Models\UserSubject;

class SubjectUserTableSeeder extends Seeder {

    public function run() {
        DB::table('subject_user')->delete();

        $user1 = DB::table('users')->where('id', '1')->first();
        $user2 = DB::table('users')->where('id', '2')->first();
        $user3 = DB::table('users')->where('id', '3')->first();

        $subject1 = DB::table('subjects')->where('id', '1')->first();
        $subject2 = DB::table('subjects')->where('id', '2')->first();
        $subject3 = DB::table('subjects')->where('id', '3')->first();
        

        $subject_user = array(
            array(
                'subject_id'	  => $subject1->id,
                'user_id'		  => $user1->id
            ),
            array(
                'subject_id'	  => $subject2->id,
                'user_id'		  => $user1->id
            ),
            array(
                'subject_id'	  => $subject1->id,
                'user_id'		  => $user2->id
            ),
            array(
                'subject_id'	  => $subject3->id,
                'user_id'		  => $user2->id
            ),
             array(
                 'subject_id'	  => $subject2->id,
                 'user_id'		  => $user3->id
             ),
            array(
                'subject_id'	  => $subject3->id,
                'user_id'		  => $user3->id
            )
        );

        DB::table('subject_user')->insert($subject_user);
    }

}