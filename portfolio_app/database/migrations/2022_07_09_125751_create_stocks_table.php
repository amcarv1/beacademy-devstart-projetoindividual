<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('ticket');
            $table->integer('category')->unsigned();
            $table->decimal('price', 8, 2);
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('stocks');
    }
};
