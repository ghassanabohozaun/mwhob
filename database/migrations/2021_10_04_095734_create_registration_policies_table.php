<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationPoliciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registration_policies', function (Blueprint $table) {
            $table->id();
            $table->string('policy_title_ar')->nullable();
            $table->string('policy_title_en')->nullable();
            $table->longText('policy_details_ar')->nullable();
            $table->longText('policy_details_en')->nullable();
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
        Schema::dropIfExists('registation_policies');
    }
}
