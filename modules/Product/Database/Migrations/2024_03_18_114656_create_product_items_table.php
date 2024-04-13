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
        Schema::create('product_items', function (Blueprint $table) {
            $table->id();
            $table->decimal("price_import")->nullable();
            $table->decimal("price")->nullable();
            $table->integer("quantity")->nullable();
            // $table->foreignId('product_variation_id')->nullable()->constrained("product_variations")->onDelete('cascade');
            $table->string("product_id")->nullable();
            $table->string("product_variation_id")->nullable();
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
        Schema::dropIfExists('product_items');
    }
};
