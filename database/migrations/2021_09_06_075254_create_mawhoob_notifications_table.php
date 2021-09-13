<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMawhoobNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mawhoob_notifications', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar')->nullable();
            $table->string('title_en')->nullable();
            $table->longText('details_ar')->nullable();
            $table->longText('details_en')->nullable();
            $table->enum('notify_status', ['send', 'received'])->default('received');
            $table->enum('notify_class', ['read', 'unread'])->default('unread');
            $table->enum('notify_for', ['admin', 'teacher','mawhob'])->default('admin');
            $table->bigInteger('admin_id')->nullable();
            $table->bigInteger('teacher_id')->nullable();
            $table->bigInteger('student_id')->nullable();
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
        Schema::dropIfExists('mawhoob_notifications');
    }
}
