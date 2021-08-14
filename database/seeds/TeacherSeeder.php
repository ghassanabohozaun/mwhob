<?php

use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Teacher::create([
            'name' => 'First Teacher',
            'email' => 'teacher@mwhob.ps',
            'password' => '$2y$10$nLk42W5/gmuL7NLfXPhvj.n8wRyJtqc.q092/eKda2JE6eVah5iYO',
            'status'=>1,
        ]);
    }
}
