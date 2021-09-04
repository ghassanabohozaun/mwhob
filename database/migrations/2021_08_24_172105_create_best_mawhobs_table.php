<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBestMawhobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('best_mawhobs', function (Blueprint $table) {
            $table->id();
            $table->integer('mawhob_id')->unsigned()->nullable();
            $table->foreign('mawhob_id')->references('id')->on('mawhobs')->onDelete('cascade');
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
        Schema::dropIfExists('best_mawhobs');
    }
}
