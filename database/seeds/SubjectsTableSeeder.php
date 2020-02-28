<?php

use Illuminate\Database\Seeder;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //borramos datos de la tabla
        DB::table('subjects')->delete();
        //rellenamos la tabla
        DB::table('subjects')->insert([[
            'subjectName' => 'Programación 1',
            'department' => 'Ciencia de la computación e inteligencia artificial'
        ],[
            'subjectName' => 'Matemáticas 1',
            'department' => 'Ciencia de la computación e inteligencia artificial'
        ],[
            'subjectName' => 'Fundamentos físicos de la informática',
            'department' => 'Fisica, Ingeniería de sistemas y teoría de la señal'
        ],[
            'subjectName' => 'Fundamentos de los computadores',
            'department' => 'Tecnología informática y computación'
        ],[
            'subjectName' => 'Sistemas y tecnologías de la información',
            'department' => 'Lenguajes y sistemas informáticos '
        ],[
            'subjectName' => 'Matemática discreta',
            'department' => 'Ciencia de la computación e inteligencia artificial'
        ],[
            'subjectName' => 'Matemáticas 2',
            'department' => 'Ciencia de la computación e inteligencia artificial'
        ],[
            'subjectName' => 'Programación 2',
            'department' => 'Lenguajes y sistemas informáticos '
        ],[
            'subjectName' => 'Fundamentos de las bases de datos',
            'department' => 'Lenguajes y sistemas informáticos '
        ],[
            'subjectName' => 'Estructuras de los computadores',
            'department' => 'Tecnología informática y computación'
        ],[
            'subjectName' => 'Estadística',
            'department' => 'Ciencia de la computación e inteligencia artificial'
        ],[
            'subjectName' => 'Programación 3',
            'department' => 'Lenguajes y sistemas informáticos '
        ],[
            'subjectName' => 'Sistemas operativos',
            'department' => 'Tecnología informática y computación'
        ]]);
    }
}
