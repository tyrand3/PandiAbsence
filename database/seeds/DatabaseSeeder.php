<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employees')->insert([
            'emp_id' => '1000',
            'timesheet_id' => '100',
            'name' => 'Human Resource',
            'job_title' => 'HR Admin',
            'entrance_date' => '2017-01-01',
            'birthday' => '1980-02-02',
            'email' => 'admin@admin.com',
            'address' => 'Jakarta Barat',
        ]);

        DB::table('users')->insert([
            'employee_id' => 1,
            'access_level' => 1,
            'password' => 'admin123',
        ]);

        $this->call(EmployeesTableSeeder::class);
    }
}
