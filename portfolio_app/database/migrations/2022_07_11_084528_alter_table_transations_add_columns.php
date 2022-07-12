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
        Schema::table('transactions', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onoDelete('cascade');
            $table->foreign('transaction_type')->references('id')->on('transactions_types')->onoDelete('cascade');
            $table->foreign('stock_id')->references('id')->on('stocks')->onoDelete('cascade');
        });    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
