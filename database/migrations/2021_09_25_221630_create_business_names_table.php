<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessNamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_names', function (Blueprint $table) {
        $table->id();
        $table->timestamps();
        $table->foreignId('user_id');
        $table->string('fullname');
        $table->string('address')->nullable();
        $table->string('email');
        $table->string('phone');
        $table->string('company_name');
        $table->string('company_address');
        $table->string('documents');
        $table->enum('payment',['completed','pending'])->default('pending');
 });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_names');
    }
}

