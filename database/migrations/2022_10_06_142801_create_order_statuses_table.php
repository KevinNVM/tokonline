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
        Schema::create('order_statuses', function (Blueprint $table) {
            $table->id();
            $table->integer('buyer_id');
            $table->integer('product_id');
            $table->integer('shop_id');
            $table->enum('status', [1, 2, 3, 4, 5, 6])->comment(' 1=waiting, 2=packed, 3=sending, 4=sent, 5=success, 6=failed');
            $table->string('reason')->nullable(true);
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
        Schema::dropIfExists('order_statuses');
    }
};