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
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->default(0)->references('id')->on('products')->onDelete('cascade');
            $table->foreignId('color_id')->default(0)->references('id')->on('colors')->onDelete('cascade');
            $table->string('size')->nullable();
            $table->tinyInteger('order')->default(1);
            $table->string('status')->default(80);
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
        Schema::dropIfExists('attributes');
    }
};
