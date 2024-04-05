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
        Schema::create('product_variations', function (Blueprint $table) {
            $table->id();
            $table->string("product_attribute_id");
            $table->string("name");
            $table->decimal("price_import")->nullable();
            $table->decimal("price");
            $table->integer("quantity");
            $table->tinyInteger("type_sell")->nullable();
            $table->decimal("value_sell");
            $table->integer("quantity_sell");
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
        Schema::dropIfExists('product_variations');
    }
};
