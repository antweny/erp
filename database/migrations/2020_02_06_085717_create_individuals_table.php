<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndividualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('individuals', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('full_name');
            $table->enum('gender', ['Male', 'Female','Not Set'])->nullable()->default('Not Set');
            $table->string('age_group')->nullable();
            $table->string('occupation')->nullable();

            $table->uuid('city_id')->nullable();
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('set null')->onUpdate('cascade');

            $table->uuid('district_id')->nullable();
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('set null')->onUpdate('cascade');

            $table->uuid('ward_id')->nullable();
            $table->foreign('ward_id')->references('id')->on('wards')->onDelete('set null')->onUpdate('cascade');

            $table->uuid('education_level_id')->nullable();
            $table->foreign('education_level_id')->references('id')->on('education_levels')->onDelete('set null')->onUpdate('cascade');

            $table->mediumText('address')->nullable();

            $table->string('mobile',15)->nullable();

            $table->string('email')->unique()->nullable();

            $table->unique(['full_name','mobile']);

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
        Schema::dropIfExists('individuals');
    }
}
