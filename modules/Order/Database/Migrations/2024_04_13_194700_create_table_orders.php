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
            $table->string("name"); // ten người nhận
            $table->string("phone"); // sdt
            $table->string("address"); 
            $table->string("address2");
            $table->string("note")->nullable();
            $table->string("order_code");
            $table->string("payment_method")->default(0);
            $table->string("payment_status")->default(0);
            $table->string("user_id")->nullable();
            $table->string("order_type")->default(0); // POS / WEB
            $table->string("order_channel")->default(0); // POS / WEB
            $table->timestamp("order_date")->nullable();
            $table->decimal("total", 10);
            $table->decimal("amount", 10);
            $table->decimal("coupon_value")->default(0);
            $table->string("coupon_id")->nullable();
            $table->decimal("shipping_price")->nullable();
            $table->tinyInteger("status")->default(0);
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
