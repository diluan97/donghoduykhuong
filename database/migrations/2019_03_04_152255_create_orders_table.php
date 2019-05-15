<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('order_number')->nullable();
            $table->string('note', 255)->nullable();
            $table->integer('total')->nulable();
            $table->string('customer_name', 255)->nullable();
            $table->string('customer_phone', 255)->nullable();
            $table->string('customer_email', 255)->nullable();
            $table->string('customer_address', 55)->nullable();
            $table->string('order_status')->nullable();
            $table->string('type_order')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
