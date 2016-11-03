<?php

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectTableSeeder extends Seeder {

    public function run() {
        DB::table('subjects')->delete();

        Subject::create([
            'subjects' => 'Accountancy & finance'
        ]);

        Subject::create([
            'subjects' => 'Agriculture & horticulture'
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
            'subjects' => 'Business & economics'
        ]);

        Subject::create([
            'subjects' => 'Cinematics & photography'
        ]);

        Subject::create([
            'subjects' => 'Communications & Journalism'
        ]);

        Subject::create([
            'subjects' => 'Computing & information technology'
        ]);

        Subject::create([
            'subjects' => 'Craft skills'
        ]);

        Subject::create([
            'subjects' => 'Culinary Arts & personal services'
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
            'subjects' => 'Food, leisure & hospitality'
        ]);

        Subject::create([
            'subjects' => 'Geography & geology'
        ]);

        Subject::create([
            'subjects' => 'History'
        ]);

        Subject::create([
            'subjects' => 'Law'
        ]);

        Subject::create([
            'subjects' => 'Literature'
        ]);

        Subject::create([
            'subjects' => 'Linguistics & classics'
        ]);

        Subject::create([
            'subjects' => 'Management'
        ]);

        Subject::create([
            'subjects' => 'Mathematics & statistics'
        ]);

        Subject::create([
            'subjects' => 'Mechanic & repair technologies'
        ]);

        Subject::create([
            'subjects' => 'Media & creative arts'
        ]);

        Subject::create([
            'subjects' => 'Medicine, dentistry & optometry'
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
            'subjects' => 'Physical sciences'
        ]);

        Subject::create([
            'subjects' => 'Psychology'
        ]);

        Subject::create([
            'subjects' => 'Social studies'
        ]);

        Subject::create([
            'subjects' => 'Sport sciences'
        ]);

        Subject::create([
            'subjects' => 'Transportation & Distribution'
        ]);

        Subject::create([
            'subjects' => 'Veterinary sciences'
        ]);

        Subject::create([
            'subjects' => 'World languages & cultural studies'
        ]);
        
    }
    
}