<?php

use Faker\Generator as Faker;

$factory->define(App\Employee::class, function (Faker $faker) {
    return [
        'emp_id' => $faker->unique()->numerify('####'),
        'timesheet_id' => $faker->unique()->numerify('###'),
        'name' => $faker->name,
        'job_title' => $faker->jobTitle,
        'entrance_date' => $faker->dateTimeThisDecade($max = '-1 year', $timezone = null),
        'birthday' => $faker->dateTimeBetween($startDate = '-50 years', $endDate = '-20 years'),
        'email' => $faker->unique()->safeEmail,
        'address' => $faker->address,
    ];
});
