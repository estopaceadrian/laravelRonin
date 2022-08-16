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
            $table->string("productname") ;
            $table->string("description")->nullable();
            $table->string("stock"); 
            $table->string("selling");
            $table->string("original");
            $table->string("type")->nullable();
            $table->string("status")->nullable();
            $table->string("image")->nullable();
            $table->string("title")->nullable();
            $table->string("keyword")->nullable();
            $table->string("mdescription")->nullable();
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
