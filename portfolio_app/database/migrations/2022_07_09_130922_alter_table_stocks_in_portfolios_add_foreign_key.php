<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        {
            Schema::table('stocks_in_portfolios', function (Blueprint $table) {
                $table->foreign('portfolio_id')->references('id')->on('portfolios')->onDelete('cascade');
                $table->foreign('stock_id')->references('id')->on('stocks')->onDelete('cascade');
            });
        }
    }

    public function down()
    {
        Schema::table('portfolios_add_foreign_key', function (Blueprint $table) {
            //
        });
    }
};
