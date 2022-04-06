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
            $table->integer('catogory_id');
            $table->string('name');
            $table->string('brand');
            $table->longtext('short_desc');
            $table->longtext('desc');
            $table->longtext('keywords');
            $table->longtext('technical_specification');
            $table->longtext('uses');
            $table->longtext('warenty');
            $table->integer('status');
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
