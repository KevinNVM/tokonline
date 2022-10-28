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
            $table->foreignId('shop_id')->constrained('shops', 'id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('catalog_id')->constrained('shop_catalogs')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('sub_category_id');
            // $table->foreign('sub_category_id')->references('id')->on('product_sub_categories')->onDelete('cascade');
            $table->string('name', 255);
            $table->string('slug');
            $table->mediumText('desc')->nullable();
            $table->integer('weight');
            $table->enum('condition', [1, 2])->comment('2=bekas, 1=baru');
            $table->integer('stock')->default(0);
            $table->bigInteger('price');
            $table->integer('sold')->default(0);
            $table->integer('visibility')->default(1)->comment('public=1, private=0, unlisted=2');
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