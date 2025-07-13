<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); 
            $table->string("orderid")->default("B234");  
            $table->unsignedBigInteger("product_id");
            $table->unsignedBigInteger("user_id");
            $table->foreign('product_id')->references("id")->on('products')->onDelete('cascade');
            $table->foreign('user_id')->references("id")->on('users')->onDelete('cascade');
            $table->integer('quantity');
            $table->text('description')->default("NotDescription");
            $table->string('size_shoes')->nullable();
            $table->string('size_clothes')->nullable();
            $table->string('color')->nullable();
            $table->decimal('price', 8, 2);
            $table->string("order_status")->default('pending');
            $table->string("action")->default('normal'); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
