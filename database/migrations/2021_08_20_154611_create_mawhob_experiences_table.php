<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMawhobExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mawhob_experiences', function (Blueprint $table) {
            $table->id();

            $table->integer('mawhob_id')->unsigned()->nullable();
            $table->foreign('mawhob_id')->references('id')->on('mawhobs')->onDelete('cascade');
            $table->integer('story_id')->unsigned()->nullable();
            $table->foreign('story_id')->references('id')->on('stories')->onDelete('cascade');
            $table->string('experience_name_ar')->nullable();
            $table->string('experience_name_en')->nullable();
            $table->integer('experience_percentage')->nullable();


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
        Schema::dropIfExists('mawhob_experiences');
    }
}
