<?php

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'site_name_ar'=>'موهوب',
            'site_name_en'=>'Mwhob',
            'site_lang_ar'=>'on',
        ]);
    }
}
