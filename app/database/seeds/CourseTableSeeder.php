<?php



class CourseTableSeeder extends Seeder
{

    public function run()
    {
        Course::create([
            'name' => 'PROGRAMACIÓN Sec.4 STGO S-SEM. 2017/1',
            'matter' => 'PROGRAMACIÓN',
            'section' => '4',
            'location' => 'STGO',
            'year' => '2017',
            'semester' => '1'
        ]);
        Course::create([
            'name' => 'PROGRAMACIÓN Sec.8 STGO S-SEM. 2017/1',
            'matter' => 'PROGRAMACIÓN',
            'section' => '8',
            'location' => 'STGO',
            'year' => '2017',
            'semester' => '1'
        ]);
    }

}