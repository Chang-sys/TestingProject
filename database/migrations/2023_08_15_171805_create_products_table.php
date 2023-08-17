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
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('title_id');
            $table->unsignedBigInteger('color_id');
            $table->unsignedBigInteger('size_id');
            $table->unsignedBigInteger('storage_id');
            $table->unsignedBigInteger('maker_id');
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('product_used_id');
            $table->unsignedBigInteger('company_id');
            $table->string('image_path');
            $table->string('title');
            $table->longText('description');
            $table->integer('stock');
            $table->decimal('price', 10,2);
            $table->integer('status');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('title_id')->references('id')->on('product_titles')->onDelete('cascade');
            $table->foreign('storage_id')->references('id')->on('product_storages')->onDelete('cascade');
            $table->foreign('color_id')->references('id')->on('product_colors')->onDelete('cascade');
            $table->foreign('size_id')->references('id')->on('product_sizes')->onDelete('cascade');
            $table->foreign('product_used_id')->references('id')->on('product_useds')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->foreign('maker_id')->references('id')->on('makers')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
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