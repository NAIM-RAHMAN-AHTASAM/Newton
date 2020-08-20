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
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('full_name');
            $table->string('email_address');
            $table->string('phone_number');
            $table->integer('country_id');
            $table->integer('city_id');
            $table->longText('address');
            $table->longText('note');
            $table->integer('sub_total');
            $table->integer('total');
            $table->string('coupon_name')->nullable();
            $table->integer('payment_method');
            $table->integer('paid_status')->default(1);
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
