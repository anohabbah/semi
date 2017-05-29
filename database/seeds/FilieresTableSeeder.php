<?php

use Illuminate\Database\Seeder;

class FilieresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $studies = [
            'Sciences Informatiques', 'Sciences Mathématiques', 'Sciences pour l\'Ingénieur'
        ];
        collect($studies)->each(function ($study) {
            \App\Filiere::create(['name' => $study]);
        });
    }
}
