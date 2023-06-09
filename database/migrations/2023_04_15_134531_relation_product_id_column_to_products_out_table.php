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
        Schema::table('products_out', function (Blueprint $table) {
            $table->index('product_id');
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products_out', function (Blueprint $table) {
            $table->dropForeign('product_id');
            $table->dropColumn('product_id');
        });
    }
};
