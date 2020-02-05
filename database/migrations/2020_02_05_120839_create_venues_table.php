<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVenuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venues', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('name')->unique();
            $table->string('slug')->unique();

            $table->string('mobile',20)->nullable();

            $table->string('email')->nullable();

            $table->enum('type',['Outdor','Indoor'])->nullable();

            $table->integer('capacity')->nullable();

            $table->uuid('city_id')->nullable();
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('set null')->onUpdate('cascade');

            $table->uuid('district_id')->nullable();
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('set null')->onUpdate('cascade');

            $table->string('contact_person',50)->nullable();
            $table->string('contact_person_number',20)->nullable();

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
        Schema::dropIfExists('venues');
    }
}
