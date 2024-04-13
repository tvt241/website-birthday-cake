<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
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
            $table->string("user_id");
            $table->string("order_code");
            $table->string("order_type")->default(0);
            $table->timestamp("order_date")->nullable();
            $table->decimal("amount");
            $table->decimal("coupon_value")->default(0);
            $table->string("coupon_id")->default(0);
            $table->decimal("shipping_price")->nullable();
            $table->string("payment_method")->default(0);
            $table->tinyInteger("payment_status")->default(0);
            $table->tinyInteger("status");
            $table->string("note");
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
};
