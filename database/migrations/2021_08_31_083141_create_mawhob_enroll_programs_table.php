<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMawhobEnrollProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mawhob_enroll_programs', function (Blueprint $table) {
            $table->id();
            $table->integer('program_id')->unsigned()->nullable();
            $table->foreign('program_id')->references('id')->on('programs')->onDelete('cascade');

            $table->integer('mawhob_id')->unsigned()->nullable();
            $table->foreign('mawhob_id')->references('id')->on('mawhobs')->onDelete('cascade');

            $table->string('enrolled_date')->nullable();
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
        Schema::dropIfExists('mawhob_enroll_programs');
    }
}
