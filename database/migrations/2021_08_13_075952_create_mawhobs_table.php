<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMawhobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mawhobs', function (Blueprint $table) {
            $table->id();
            $table->string('photo')->nullable();
            $table->string('mawhob_full_name')->nullable();
            $table->string('mawhob_mobile_no')->nullable();
            $table->string('mawhob_password')->nullable();
            $table->string('mawhob_whatsapp_no')->nullable();
            $table->string('mawhob_birthday')->nullable();
            $table->enum('mowhob_gender', ['male', 'female'])->default('male');
            $table->integer('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->text('portfolio')->nullable();
            $table->string('freeze')->nullable();
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
        Schema::dropIfExists('mawhobs');
    }
}
