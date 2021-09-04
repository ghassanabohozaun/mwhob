<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndexPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('index_pages', function (Blueprint $table) {
            $table->id();
            $table->text('mawhobs_description_ar')->nullable();
            $table->text('mawhobs_description_en')->nullable();
            $table->text('courses_description_ar')->nullable();
            $table->text('courses_description_en')->nullable();
            $table->text('best_mawhobs_description_ar')->nullable();
            $table->text('best_mawhobs_description_en')->nullable();
            $table->text('best_courses_description_ar')->nullable();
            $table->text('best_courses_description_en')->nullable();
            $table->text('about_team_ar')->nullable();
            $table->text('about_team_en')->nullable();
            $table->text('our_mission_ar')->nullable();
            $table->text('our_mission_en')->nullable();
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
        Schema::dropIfExists('index_pages');
    }
}
