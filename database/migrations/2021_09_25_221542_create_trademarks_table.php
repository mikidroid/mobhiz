<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrademarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trademarks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
$table->foreignId('user_id');
$table->string('fullname');
$table->string('address')->nullable();
$table->string('email');
$table->string('phone');
$table->string('company_name');
$table->string('company_address');
$table->string('product_names');
$table->string('payment')->default('pending');
$table->string('documents');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trademarks');
    }
}
