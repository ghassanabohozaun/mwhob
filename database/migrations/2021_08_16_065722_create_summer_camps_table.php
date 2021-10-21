<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSummerCampsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('summer_camps', function (Blueprint $table) {
            $table->id();
            $table->string('summer_camp_image')->nullable();
            $table->string('slug_name_ar')->nullable();
            $table->string('slug_name_en')->nullable();
            $table->string('name_ar')->nullable();
            $table->string('name_en')->nullable();
            $table->longText('short_description_ar')->nullable();
            $table->longText('short_description_en')->nullable();

            $table->double('cost')->nullable();
            $table->double('discount')->nullable();
            $table->string('year')->nullable();
            $table->string('start_at')->nullable();
            $table->string('end_at')->nullable();
            $table->string('status')->nullable();
            $table->string('enable_enrolling')->nullable();

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
        Schema::dropIfExists('summer_camps');
    }
}
