<?php

use Illuminate\Database\Seeder;

class StaticStringsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\StaticString::create([
            'talents_description_ar' => null,
            'talents_description_en' => null,
            'soundtrack_description_ar' => null,
            'soundtrack_description_en' => null,
            'videos_description_ar' => null,
            'videos_description_en' => null,
            'success_stories_description_ar' => null,
            'success_stories_description_en' => null,
            'programs_description_ar' => null,
            'programs_description_en' => null,
            'courses_description_ar' => null,
            'courses_description_en' => null,
            'contests_description_ar' => null,
            'contests_description_en' => null,
            'summer_camps_description_ar' => null,
            'summer_camps_description_en' => null,
            'magazine_description_ar' => null,
            'magazine_description_en' => null,
        ]);
    }
}
