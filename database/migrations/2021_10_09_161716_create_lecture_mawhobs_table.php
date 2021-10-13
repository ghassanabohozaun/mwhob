<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLectureMawhobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lecture_mawhobs', function (Blueprint $table) {
            $table->id();

            $table->integer('course_id')->unsigned()->nullable();
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');


            $table->integer('lecture_id')->unsigned()->nullable();
            $table->foreign('lecture_id')->references('id')->on('lectures')->onDelete('cascade');

            $table->integer('mawhob_id')->unsigned()->nullable();
            $table->foreign('mawhob_id')->references('id')->on('mawhobs')->onDelete('cascade');

            $table->string('status')->nullable();

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
        Schema::dropIfExists('lecture_mawhobs');
    }
}
