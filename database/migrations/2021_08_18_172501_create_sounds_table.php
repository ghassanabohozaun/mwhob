<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sounds', function (Blueprint $table) {
            $table->id();
            $table->string('sound_image')->nullable();
            $table->string('slug_name_ar')->nullable();
            $table->string('slug_name_en')->nullable();
            $table->string('name_ar')->nullable();
            $table->string('name_en')->nullable();
            $table->string('date')->nullable();
            $table->integer('length')->nullable();
            $table->string('sound_class')->nullable();
            $table->string('youtube_link')->nullable();
            $table->string('vimeo_link')->nullable();
            $table->string('upload_sound_link')->nullable();
            $table->string('short_youtube_link')->nullable();
            $table->string('short_vimeo_link')->nullable();
            $table->string('short_upload_sound_link')->nullable();
            $table->string('views')->nullable();
            $table->enum('language', ['ar', 'ar_en'])->default('ar');
            $table->string('status')->nullable();
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
        Schema::dropIfExists('sounds');
    }
}
