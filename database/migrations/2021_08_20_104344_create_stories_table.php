<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stories', function (Blueprint $table) {
            $table->id();
            $table->string('story_icon')->nullable();
            $table->string('story_image')->nullable();
            $table->longText('about_mawhob_ar')->nullable();
            $table->longText('about_mawhob_en')->nullable();
            $table->integer('mawhob_id')->unsigned()->nullable();
            $table->foreign('mawhob_id')->references('id')->on('mawhobs')->onDelete('cascade');
            $table->integer('story_category_id')->unsigned()->nullable();
            $table->foreign('story_category_id')->references('id')->on('story_categories')->onDelete('cascade');
            $table->string('status')->nullable();
            $table->enum('language', ['ar', 'ar_en'])->default('ar');
            $table->softDeletes();
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
        Schema::dropIfExists('stories');
    }
}
