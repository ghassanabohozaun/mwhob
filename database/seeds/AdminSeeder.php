<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'teacher_full_name' => 'admin',
            'teacher_email' => 'admin@admin.com',
            'password' => '$2y$10$7oMefZl1L95XO5zSHAufv.JiaRzPod4LHahnkKwW3CjtfBrXfmiN2',
            'status'=>'on',
        ]);
    }
}
