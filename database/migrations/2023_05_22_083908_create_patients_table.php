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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->string('nation');         
            $table->string('sex');
            $table->date('birth');
            $table->string('address');
            $table->string('profession');
            $table->string('allergies');
            $table->string('history_diseases');
            $table->string('ex_surgery');
            $table->string('vaccine');
            $table->string('hereditary');
            $table->string('insurance');
            $table->string('emergency_contact');
            $table->string('blood_type');
            $table->string('language');
            $table->string('marital_status');
            $table->foreignId('users_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('patient');
    }
};
