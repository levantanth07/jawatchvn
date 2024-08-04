<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
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
            $table->string('name')->index()->nullable();
            $table->string('slug')->index()->nullable();
            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->string('image')->nullable();
            $table->decimal('price', 20)->index()->nullable();
            $table->decimal('sale_price', 20)->index()->nullable();
            $table->integer('category_id')->index()->nullable();
            $table->integer('campaign_id')->index()->nullable();
            $table->tinyInteger('status')->index()->nullable();
            $table->tinyInteger('is_stock')->index()->nullable();
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
}
