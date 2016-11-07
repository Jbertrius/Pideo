<?php

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectTableSeeder extends Seeder {

    public function run() {
        DB::table('subjects')->delete();
        

        Subject::create([
            'subjects'    =>       'Analyse'
        ]);

        Subject::create([
            'subjects'    =>       'Algèbre'
        ]);

        Subject::create([
            'subjects'    =>       'Algorithme'
        ]);

        Subject::create([
            'subjects'    =>       'Atomistique'
        ]);

        Subject::create([
            'subjects'    =>       'Analyse Numérique'
        ]);

        Subject::create([
            'subjects'    =>       'Analyse Diagnostique Financière'
        ]);

        Subject::create([
            'subjects'    =>       'Biologie Animale'
        ]);

        Subject::create([
            'subjects'    =>       'Biologie Vétérane'
        ]);

        Subject::create([
            'subjects'    =>       'Bricolage'
        ]);

        Subject::create([
            'subjects'    =>       'Chimie Organique'
        ]);

        Subject::create([
            'subjects'    =>       'Chimie Naturelle'
        ]);

        Subject::create([
            'subjects'    =>       'Comptabilité'
        ]);

        Subject::create([
            'subjects'    =>       'Cuisine'
        ]);

        Subject::create([
            'subjects'    =>       'Culture Générale'
        ]);

        Subject::create([
            'subjects'    =>       'Dance '
        ]);

        Subject::create([
            'subjects'    =>       'Drame'
        ]);

        Subject::create([
            'subjects'    =>       'Electrocinétique'
        ]);

        Subject::create([
            'subjects'    =>       'Electromagnétique'
        ]);

        Subject::create([
            'subjects'    =>       'Electrostatique'
        ]);

        Subject::create([
            'subjects'    =>       'Electronique Numérique'
        ]);

        Subject::create([
            'subjects'    =>       'Electronique Analogique'
        ]);

        Subject::create([
            'subjects'    =>       'Finance'
        ]);

        Subject::create([
            'subjects'    =>       'Force de Matériaux'
        ]);

        Subject::create([
            'subjects'    =>       'Histoire'
        ]);

        Subject::create([
            'subjects'    =>       'Java'
        ]);

        Subject::create([
            'subjects'    =>       'Linguistiques'
        ]);

        Subject::create([
            'subjects'    =>       'Mathématiques'
        ]);

        Subject::create([
            'subjects'    =>       'Mécanique de Point'
        ]);

        Subject::create([
            'subjects'    =>       'Mécanique de Fluide'
        ]);

        Subject::create([
            'subjects'    =>       'Mécanique de Solide'
        ]);

        Subject::create([
            'subjects'    =>       'Music'
        ]);

        Subject::create([
            'subjects'    =>       'Psychologie'
        ]);

        Subject::create([
            'subjects'    =>       'Philosophie'
        ]);

        Subject::create([
            'subjects'    =>       'Religion'
        ]);

        Subject::create([
            'subjects'    =>       'Statistique'
        ]);

        Subject::create([
            'subjects'    =>       'Thermodynamique'
        ]);

        Subject::create([
            'subjects'    =>       'Thermodynamique Appliquée'
        ]);

        Subject::create([
            'subjects'    =>       'Topologie'
        ]);


    }
    
}