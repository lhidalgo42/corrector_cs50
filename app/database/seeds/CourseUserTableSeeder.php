<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class CourseUserTableSeeder extends Seeder
{

    public function run()
    {
        foreach (range(1, 2) as $teacher) {
            foreach (range(1, 2) as $couse) {
                CourseUser::create([
                    'course_id' => $couse,
                    'user_id' => $teacher
                ]);
            }
        }
    }

}