<?php

use Illuminate\Database\Seeder;

class AboutMawhobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\AboutMawhob::create([
            'title_ar' => null,
            'title_en' => null,
            'summary_ar' => null,
            'summary_en' => null,
            'details_ar' => null,
            'details_en' => null,
            'video' => null,
        ]);
    }
}
