<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
$table->foreignId('user_id');
$table->enum('type',['product registration','certificate replacement','trademark registration','cac registration']);
$table->string('fullname');
$table->string('email');
$table->string('phone');
$table->string('company_name');
$table->string('company_address')->nullable();
$table->text('product_names')->nullable();
$table->string('ref_id');
$table->enum('mode',['not running','running','expired'])->nullable();
$table->bigInteger('nafdac_status')->default(0);
$table->bigInteger('status')->default(0);
//$table->enum('status',['order created','payment complete','processing','process complete'])->default('Order created');
$table->enum('payment',['completed','pending'])->default('pending');
$table->foreignId('register_product_id')->nullable();
$table->foreignId('replace_cert_id')->nullable();
$table->foreignId('trademark_id')->nullable();
$table->foreignId('business_name_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
