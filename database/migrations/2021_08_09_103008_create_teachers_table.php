<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('teacher_photo')->nullable();
            $table->string('slug_teacher_full_name')->nullable();
            $table->string('teacher_full_name')->nullable();
            $table->string('teacher_email')->nullable();
            $table->longText('teacher_bio')->nullable();
            $table->string('password')->nullable();
            $table->string('teacher_mobile_no')->nullable();
            $table->string('teacher_whatsapp_no')->nullable();
            $table->string('teacher_qualification')->nullable();
            $table->string('teacher_cv')->nullable();
            $table->string('teacher_photos_and_videos_link')->nullable();
            $table->enum('teacher_gender', ['male', 'female'])->default('male');
            $table->string('teacher_freeze')->nullable();
            $table->datetime('teacher_last_login_at')->nullable();
            $table->string('teacher_last_login_ip')->nullable();
            $table->string('teacher_remember_token')->nullable();
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
        Schema::dropIfExists('teachers');
    }
}
