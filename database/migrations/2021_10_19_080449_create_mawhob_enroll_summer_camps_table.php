<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMawhobEnrollSummerCampsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mawhob_enroll_summer_camps', function (Blueprint $table) {
            $table->id();
            $table->integer('summer_camp_id')->unsigned()->nullable();
            $table->foreign('summer_camp_id')->references('id')->on('SummerCamp')->onDelete('cascade');

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
        Schema::dropIfExists('mawhob_enroll_summer_camps');
    }
}
