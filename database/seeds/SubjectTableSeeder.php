<?php

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectTableSeeder extends Seeder {

    public function run() {
        DB::table('subjects')->delete();
        Subject::create([
            'subjects' => 'Mathematics'
        ]);

        Subject::create([
            'subjects' => 'Physics'
        ]);


        Subject::create([
            'subjects' => 'Thermo'
        ]);
    }
    
}