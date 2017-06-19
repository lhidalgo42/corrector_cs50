<?php

class UserTableSeeder extends Seeder
{

    public function run()
    {
        User::create([
            'name' => 'Leonardo Hidalgo',
            'email' => 'lhidalgo@alumnos.uai.cl',
            'password' => '4380.UoY'
        ]);
        User::create([
            'name' => 'Pablo Carrasco',
            'email' => 'pablo.carrasco.m@uai.cl',
            'password' => '2890.Rsq'
        ]);
        User::create([
            'name' => 'Cristobal Ugarte',
            'email' => 'crugaterte@uai.cl',
            'password' => '3378-SsW'
        ]);
        User::create([
            'name' => 'Francisco Schwarzenberg',
            'email' => 'fschwarzenberg@uai.cl',
            'password' => '12345'
        ]);
    }

}