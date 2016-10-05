<?php

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectTableSeeder extends Seeder {

    public function run() {
        DB::table('subjects')->delete();

        Subject::create([
            'subjects' => 'Accountancy, finance, business & management studies'
        ]);

        Subject::create([
            'subjects' => 'Agriculture, horticulture & veterinary sciences'
        ]);

        Subject::create([
            'subjects' => 'Architecture, building & planning'
        ]);

        Subject::create([
            'subjects' => 'Art & design'
        ]);

        Subject::create([
            'subjects' => 'Biological sciences'
        ]);

        Subject::create([
            'subjects' => 'Cinematics & photography'
        ]);

        Subject::create([
            'subjects' => 'Computing & information technology'
        ]);

        Subject::create([
            'subjects' => 'Craft skills'
        ]);

        Subject::create([
            'subjects' => 'Dance & drama'
        ]);

        Subject::create([
            'subjects' => 'Education & teaching'
        ]);

        Subject::create([
            'subjects' => 'Engineering & manufacturing'
        ]);

        Subject::create([
            'subjects' => 'English language & literature'
        ]);

        Subject::create([
            'subjects' => 'Food, leisure & hospitality'
        ]);

        Subject::create([
            'subjects' => 'Geography & geology'
        ]);

        Subject::create([
            'subjects' => 'History'
        ]);

        Subject::create([
            'subjects' => 'Linguistics & classics'
        ]);

        Subject::create([
            'subjects' => 'Mathematics & statistics'
        ]);

        Subject::create([
            'subjects' => 'Media & creative arts'
        ]);

        Subject::create([
            'subjects' => 'Medicine, dentistry & optometry'
        ]);

        Subject::create([
            'subjects' => 'Law'
        ]);

        Subject::create([
            'subjects' => 'Modern European languages & cultural studies' ,

        ]);

            Subject::create([
                'subjects' => 'Music'
            ]);

        Subject::create([
            'subjects' => 'Nursing, health & wellbeing'
        ]);

        Subject::create([
            'subjects' => 'Philosophy, theology & religion'
        ]);

        Subject::create([
            'subjects' => 'Physical Sciences'
        ]);

        Subject::create([
            'subjects' => 'Social studies'
        ]);

        Subject::create([
            'subjects' => 'Sport sciences'
        ]);

        Subject::create([
            'subjects' => 'Mechanic and Repair Technologies'
        ]);

        Subject::create([
            'subjects' => 'World languages & cultural studies'
        ]);

        Subject::create([
            'subjects' => 'Culinary Arts and Personal Services'
        ]);

        Subject::create([
            'subjects' => 'Transportation and Distribution'
        ]);

        Subject::create([
            'subjects' => 'Communications and Journalism'
        ]);

        Subject::create([
            'subjects' => 'Psychology'
        ]);

        Subject::create([
            'subjects' => 'Business and economics'
        ]);




    }
    
}