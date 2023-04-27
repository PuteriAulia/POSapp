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
        Schema::create('products_out', function (Blueprint $table) {
            $table->string('productOut_id',10)->primary();
            $table->integer('productOut_qty');
            $table->date('productOut_date');
            $table->text('productOut_info');
            $table->string('product_id',10);
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
        Schema::dropIfExists('products_out');
    }
};
