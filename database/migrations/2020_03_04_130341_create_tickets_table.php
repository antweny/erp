<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('title');

            $table->uuid('employee_id')->nullable();
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('set null')->onUpdate('cascade');

            $table->uuid('ticket_category_id')->nullable();
            $table->foreign('ticket_category_id')->references('id')->on('ticket_categories')->onDelete('set null')->onUpdate('cascade');

            $table->enum('priority',['L','M','H','U'])->default('L');

            $table->enum('status',['O','C'])->default('O');

            $table->text('desc')->nullable();

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
        Schema::dropIfExists('tickets');
    }
}
