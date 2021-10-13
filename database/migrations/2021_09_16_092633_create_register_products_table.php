<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegisterProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('register_products', function (Blueprint $table) {
         $table->id();
         $table->timestamps();
$table->foreignId('user_id');
$table->string('fullname');
$table->string('email');
$table->string('phone');
$table->string('company_name');
$table->string('company_address');
$table->string('company_email');
$table->json('company_phones');
$table->text('product_names');
$table->string('documents');
$table->enum('type',['new','renewal']);
$table->enum('payment',['pending','completed'])->default('pending');
        }); }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('register_products');
    }
}


