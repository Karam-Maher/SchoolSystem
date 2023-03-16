<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my__parents', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password');

            //Fatherinformation
            $table->string('name_father');
            $table->string('national_id_father');
            $table->string('passport_id_father');
            $table->string('phone_father');
            $table->string('job_father');
            $table->foreignId('nationality_father_id')
                ->references('id')
                ->on('nationalities');
            $table->foreignId('blood_type_father_id')
                ->references('id')
                ->on('type_bloods');
            $table->foreignId('religion_father_id')
                ->references('id')
                ->on('religions');
            $table->string('address_father');

            //Mother information
            $table->string('name_mother');
            $table->string('national_id_mother');
            $table->string('passport_id_mother');
            $table->string('phone_mother');
            $table->string('job_mother');
            $table->foreignId('nationality_mother_id')
                ->references('id')
                ->on('nationalities');
            $table->foreignId('blood_type_mother_id')
                ->references('id')
                ->on('type_bloods');
            $table->foreignId('religion_mother_id')
                ->references('id')
                ->on('religions');
            $table->string('address_mother');
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
        Schema::dropIfExists('my__parents');
    }
};
