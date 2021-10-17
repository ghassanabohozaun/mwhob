<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaticStringsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('static_strings', function (Blueprint $table) {
            $table->id();
            $table->text('talents_description_ar')->nullable();
            $table->text('talents_description_en')->nullable();
            $table->text('soundtrack_description_ar')->nullable();
            $table->text('soundtrack_description_en')->nullable();
            $table->text('videos_description_ar')->nullable();
            $table->text('videos_description_en')->nullable();
            $table->text('success_stories_description_ar')->nullable();
            $table->text('success_stories_description_en')->nullable();

            $table->text('success_story_categories_description_ar')->nullable();
            $table->text('success_story_categories_description_en')->nullable();
            $table->text('success_story_description_ar')->nullable();
            $table->text('success_story_description_en')->nullable();
            $table->text('success_story_person_description_ar')->nullable();
            $table->text('success_story_person_description_en')->nullable();
            $table->text('programs_description_ar')->nullable();
            $table->text('programs_description_en')->nullable();
            $table->text('courses_description_ar')->nullable();
            $table->text('courses_description_en')->nullable();
            $table->text('contests_description_ar')->nullable();
            $table->text('contests_description_en')->nullable();
            $table->text('summer_camps_description_ar')->nullable();
            $table->text('summer_camps_description_en')->nullable();
            $table->text('magazine_description_ar')->nullable();
            $table->text('magazine_description_en')->nullable();
            $table->text('latest_winners_description_ar')->nullable();
            $table->text('latest_winners_description_en')->nullable();
            $table->longText('terms_of_registration_for_the_contest_ar')->nullable();
            $table->longText('terms_of_registration_for_the_contest_en')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('static_strings');
    }
}
