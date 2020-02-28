<?php

use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //borramos datos de la tabla
        DB::table('students')->delete();
        //rellenamos la tabla
        DB::table('students')->insert([[
            'phone' => '+34112893389',
            'description' => 'Años de experiencia en la gestión de sistemas.'
        ],[
            'phone' => '+34961967275',
            'description' => 'Soy una persona emprendedora, que adora los retos y no se rinde fácilmente.'
        ],[
            'phone' => '+34781905180',
            'description' => 'Tras años de experiencia, he tomado la decisión de reorientar mi carrera profesional con el ánimo de continuar aprendiendo y, también, aportar toda mi experiencia adquirida.'
        ],[
            'phone' => '+34031286307',
            'description' => 'Mi objetivo principal es desarrollarme profesionalmente y evolucionar en mi sector.'
        ],[
            'phone' => '+34152042041',
            'description' => 'Soy juan y me gusta laravel'
        ],[
            'phone' => '+34438898335',
            'description' => 'Me llamo pedro y PartnerMe es una aplicación genial'
        ]]);
    }
}
