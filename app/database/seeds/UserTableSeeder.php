<?php

class UserTableSeeder extends Seeder
{

    public function run()
    {
        User::create([
            'name' => 'Leonardo Hidalgo',
            'email' => 'lhidalgo@alumnos.uai.cl',
            'password' => '12345'
        ]);
        User::create([
            'name' => 'Pablo Carrasco',
            'email' => 'pablo.carrasco.m@uai.cl',
            'password' => '12345'
        ]);
        User::create([
            'name' => 'Cristobal Ugarte',
            'email' => 'crugaterte@uai.cl',
            'password' => '12345'
        ]);
        User::create([
            'name' => 'Francisco Schwarzenberg',
            'email' => 'fschwarzenberg@uai.cl',
            'password' => '12345'
        ]);
    }

}