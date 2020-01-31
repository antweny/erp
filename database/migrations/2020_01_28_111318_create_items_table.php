<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->unique();
            
            $table->uuid('item_category_id')->nullable();
            $table->foreign('item_category_id')->references('id')->on('item_categories')->onDelete('set null')->onUpdate('cascade');

            $table->uuid('item_unit_id')->nullable();
            $table->foreign('item_unit_id')->references('id')->on('item_units')->onUpdate('cascade')->onDelete('set null');

            $table->float('min_quantity')->default(0);
            $table->float('quantity')->default(0);
            
            $table->mediumText('desc')->nullable();
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
        Schema::dropIfExists('items');
    }
}
