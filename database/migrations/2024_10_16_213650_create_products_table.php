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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps(); 
            $table->string( 'name'); 
            $table->string( 'image')->nullable(); 
            $table->integer('stock'); 
            $table->decimal('price', 8, 2);
            $table->text('description')->default("NotDescription");
            $table->string('brand')->default("unknown");
            $table->string('size_shoes')->nullable();
            $table->string('size_clothes')->nullable();
            $table->string('color')->nullable();
        });

         
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }

};
