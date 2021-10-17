<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMawhobEnrolledContestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mawhob_enrolled_contests', function (Blueprint $table) {
            $table->id();
            $table->integer('contest_id')->unsigned()->nullable();
            $table->foreign('contest_id')->references('id')->on('contests')->onDelete('cascade');
            $table->integer('mawhob_id')->unsigned()->nullable();
            $table->foreign('mawhob_id')->references('id')->on('mawhobs')->onDelete('cascade');
            $table->string('enrolled_date')->nullable();
            $table->enum('mawhob_winner', ['true', 'false'])->default('false');
            $table->longText('mawhob_winner_description_ar')->nullable();
            $table->longText('mawhob_winner_description_en')->nullable();
            $table->enum('language', ['ar', 'ar_en'])->default('ar');
            $table->text('link')->nullable();
            $table->text('file')->nullable();
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
        Schema::dropIfExists('mawhob_enrolled_contests');
    }
}
