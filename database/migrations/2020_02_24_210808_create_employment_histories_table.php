<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmploymentHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employment_histories', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('employee_id');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade')->onUpdate('cascade');

            $table->uuid('employment_type_id')->nullable();
            $table->foreign('employment_type_id')->references('id')->on('employment_types')->onDelete('set null')->onUpdate('cascade');

            $table->uuid('designation_id')->nullable();
            $table->foreign('designation_id')->references('id')->on('designations')->onDelete('set null')->onUpdate('cascade');

            $table->date('start_date');

            $table->date('end_date')->nullable();

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
        Schema::dropIfExists('employment_histories');
    }
}
