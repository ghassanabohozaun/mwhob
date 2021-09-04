<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWhyChooseUsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('why_choose_us', function (Blueprint $table) {
            $table->id();
            $table->text('why_choose_us_ar')->nullable();
            $table->text('why_choose_us_en')->nullable();
            $table->string('reason_1')->nullable();
            $table->string('reason_2')->nullable();
            $table->string('reason_3')->nullable();
            $table->string('reason_4')->nullable();
            $table->string('reason_5')->nullable();
            $table->string('reason_6')->nullable();
            $table->string('reason_7')->nullable();
            $table->string('reason_en_1')->nullable();
            $table->string('reason_en_2')->nullable();
            $table->string('reason_en_3')->nullable();
            $table->string('reason_en_4')->nullable();
            $table->string('reason_en_5')->nullable();
            $table->string('reason_en_6')->nullable();
            $table->string('reason_en_7')->nullable();
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
        Schema::dropIfExists('why_choose_us');
    }
}
