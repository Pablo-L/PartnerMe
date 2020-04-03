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
        /*DB::table('subjects')->insert([[
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
        ]]);*/
        DB::table('subjects')->insert([[
            'subjectName' => 'Matematicas 1',
            'department'  => 'Ciencia De La Computacion e Inteligencia Artificial'
        ],[
            'subjectName' => 'Fundamentos Fisicos De La Informatica',
            'department'  => 'Fisica ,Ingenieria De Sistemas Y Teoria De La Señal'
        ],[
            'subjectName' => 'Fundamentos De Los Computadores',
            'department'  => 'Tecnología Informática Y Computación'
        ],[
            'subjectName' => 'Programacion 1',
            'department'  => 'Ciencia De La Computacion e Inteligencia Artificial'
        ],[
            'subjectName' => 'Sistemas Y Tecnologías De Información',
            'department'  => 'Lenguajes Y Sistemas Informáticos'
        ],[
            'subjectName' => 'Matematica Discreta',
            'department'  => 'Ciencia De La Computacion e Inteligencia Artificial'
        ],[
            'subjectName' => 'Matematicas 2',
            'department'  => 'Ciencia De La Computacion e Inteligencia Artificial'
        ],[
            'subjectName' => 'Programacion 2',
            'department'  => 'Lenguajes Y Sistemas Informáticos'
        ],[
            'subjectName' => 'Fundamentos De Las Bases De Datos',
            'department'  => 'Lenguajes Y Sistemas Informáticos'
        ],[
            'subjectName' => 'Estructura De Los Computadores',
            'Tecnología Informática Y Computación'
        ],[
            'subjectName' => 'Programacion 3',
            'department'  => 'Lenguajes Y Sistemas Informáticos'
        ],[
            'subjectName' => 'Sistemas Operativos',
            'department'  => 'Tecnología Informática Y Computación'
        ],[
            'subjectName' => 'Diseño De Bases De Datos',
            'department'  => 'Lenguajes Y Sistemas Informáticos'
        ],[
            'subjectName' => 'Redes De Computadores',
            'department'  => 'Fisica ,Ingenieria De Sistemas Y Teoria De La Señal'
        ],[
            'subjectName' => 'Programacion Y Estructuras De Datos',
            'department'  => 'Lenguajes Y Sistemas Informáticos'
        ],[
            'subjectName' => 'Lenguajes Y Paradigmas De Programacion',
            'department'  => 'Ciencia De La Computacion e Inteligencia Artificial'
        ],[
            'subjectName' => 'Analisis Y Diseño De Algoritmos',
            'department'  => 'Lenguajes Y Sistemas Informáticos'
        ],[
            'subjectName' => 'Herramientas Avanzadas Para El Desarrollo De Aplicaciones',
            'department'  => 'Lenguajes Y Sistemas Informáticos'
        ],[
            'subjectName' => 'Arquitectura De Los Computadores',
            'Tecnología Informática Y Computación'
        ],[
            'subjectName' => 'Sistemas Distribuidos',
            'department'  => 'Tecnología Informática Y Computación'
        ],[
            'subjectName' => 'Analisis Y Especificacion De Sistemas Software',
            'department'  => 'Lenguajes Y Sistemas Informáticos'
        ],[
            'subjectName' => 'Sistemas Inteligentes',
            'department'  => 'Ciencia De La Computacion e Inteligencia Artificial'
        ],[
            'subjectName' => 'Administracion De Sistemas Operativos Y De Redes De Computadores',
            'department'  => 'Tecnología Informática Y Computación'
        ],[
            'subjectName' => 'Ingenieria De Los Computadores',
            'department'  => 'Tecnología Informática Y Computación'
        ],[
            'subjectName' => 'Diseño De Sistemas Software',
            'department'  => 'Lenguajes Y Sistemas Informáticos'
        ],[
            'subjectName' => 'Planificación Y Pruebas De Sistemas Software',
            'department'  => 'Ciencia De La Computacion e Inteligencia Artificial'
        ],[
            'subjectName' => 'Gestion De Proyectos Informaticos',
            'Ciencia De La Computacion e Inteligencia Artificial'
        ]]);
    }
}
