<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenderSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gender_series', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('topic');

            $table->uuid('coordinator')->nullable();
            $table->foreign('coordinator')->references('id')->on('employees')->onDelete('set null')->onUpdate('cascade');

            $table->uuid('facilitator')->nullable();
            $table->foreign('facilitator')->references('id')->on('individuals')->onDelete('set null')->onUpdate('cascade');

            $table->text('follow_up')->nullable();

            $table->date('date');

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
        Schema::dropIfExists('gender_series');
    }
}
