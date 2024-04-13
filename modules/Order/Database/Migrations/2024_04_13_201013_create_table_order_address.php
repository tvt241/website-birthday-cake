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
        Schema::create('order_address', function (Blueprint $table) {
            $table->id();
            $table->string("order_id");
            $table->string("user_id");
            $table->string("full_name");
            $table->string("phone");
            $table->string("mail")->nullable();
            $table->string("province_code");
            $table->string("province_name");
            $table->string("district_code");
            $table->string("district_name");
            $table->string("ward_code");
            $table->string("ward_name");
            $table->string("address");
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
        Schema::dropIfExists('order_address');
    }
};
