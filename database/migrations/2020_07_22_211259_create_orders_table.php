<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shoppingcart_id')->constrained('shoppingcarts')->onDelete('cascade');
            $table->decimal('order_amount', 5, 4);
            $table->string('status', 30)->nullable();
            $table->string('bank', 20)->nullable();
            $table->integer('how_many_installments')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unique('shoppingcart_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
