<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('msisdn')->unique()->nullable();
            $table->date('dob')->nullable();
            $table->integer('age')->nullable();
            $table->string('home_country')->nullable();   
            $table->string('present_country')->nullable();   
            $table->text('permanent_address')->nullable();   
            $table->text('present_address')->nullable();   
            $table->integer('is_from_musical_institute')->nullable();   
            $table->string('musical_institute_name')->nullable();   
            $table->integer('participated_before')->nullable();   
            $table->string('participated_in_show')->nullable();   
            $table->string('file')->nullable();   
            $table->string('registration_type')->nullable();   
            $table->integer('created_by')->nullable();   
            $table->integer('updated_by')->nullable();   
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
        Schema::dropIfExists('participants');
    }
}
