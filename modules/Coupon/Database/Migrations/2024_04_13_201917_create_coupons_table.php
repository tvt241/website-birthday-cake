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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("code");
            $table->decimal("discount_value");
            $table->string("discount_type");
            $table->decimal("discount_max")->nullable();
            $table->integer("quantity");
            $table->integer("available");
            $table->decimal("budget")->nullable();
            $table->integer("limit_per_user")->nullable();
            $table->string("desc")->nullable();
            $table->timestamp("date_start");
            $table->timestamp("date_end")->nullable();
            $table->tinyInteger("is_active");
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
        Schema::dropIfExists('coupons');
    }
};
