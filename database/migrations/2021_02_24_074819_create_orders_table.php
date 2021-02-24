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
            $table->string('item_name');
            $table->string('item_description');
            $table->string('transport_mode');
            $table->string('item_weight');
            $table->string('country_of_origin');
            $table->bigInteger('customer_id')->unsigned()->index();
            $table->string('custom_tax');
            $table->string('shipping_cost');
            $table->string('total');
            $table->boolean('is_paid')->default(false);
            $table->string('reference_no')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
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
