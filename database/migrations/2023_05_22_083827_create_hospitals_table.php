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
        Schema::create('hospitals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('number_fix')->nullable();
            $table->string('email');
            $table->string('address');
            $table->string('city');
            $table->string('number_mobile')->nullable();
            $table->string('number_urgence')->nullable();
            $table->time('hours')->nullable();
            $table->longText('description')->nullable();
            $table->string('language');
            $table->foreignId('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('hospital');
    }
};
