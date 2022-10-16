<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->text('image')->default(json_encode(['default_product.png']));
            $table->foreignId('shop_id');
            $table->foreignId('catalog_id');
            $table->foreignId('sub_category_id');
            $table->string('name', 255);
            $table->string('slug');
            $table->text('desc')->nullable();
            $table->integer('weight');
            $table->integer('condition');
            $table->integer('stock')->default(0);
            $table->bigInteger('price');
            $table->integer('sold')->default(0);
            $table->integer('visibility')->default(1);
            $table->integer('disabled')->default(0);
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