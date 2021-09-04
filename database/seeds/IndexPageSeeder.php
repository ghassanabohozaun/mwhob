<?php

use Illuminate\Database\Seeder;

class IndexPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\IndexPage::create([
            'header_title_ar' => null,
            'header_title_en' => null,
            'header_description_ar' => null,
            'header_description_en' => null,
            'best_mawhobs_description_ar' => null,
            'best_mawhobs_description_en' => null,
            'best_courses_description_ar' => null,
            'best_courses_description_en' => null,
            'about_team_ar' => null,
            'about_team_en' => null,
            'our_mission_ar' => null,
            'our_mission_en' => null,

        ]);
    }
}
