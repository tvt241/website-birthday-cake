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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("slug")->nullable();
            $table->string("category_id")->nullable();
            $table->decimal("min_price")->default(0);
            $table->decimal("max_price")->default(0);
            $table->string("desc_sort")->nullable();
            $table->longText("desc")->nullable();
            $table->tinyInteger("is_active")->default(0);
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
        Schema::dropIfExists('products');
    }
};
