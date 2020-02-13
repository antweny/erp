<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemReceivedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_received', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->date('date_received');

            $table->uuid('item_id');
            $table->foreign('item_id')->references('id')->on('items')->onUpdate('cascade')->onDelete('cascade');

            $table->mediumText('desc')->nullable();


            $table->decimal('unit_rate',13,2);
            $table->bigInteger('quantity');

            $table->decimal('amount',13,2);
            $table->mediumText('remarks')->nullable();
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
        Schema::dropIfExists('item_received');
    }
}
