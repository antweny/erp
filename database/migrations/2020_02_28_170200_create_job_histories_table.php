<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_histories', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('employee_id');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade')->onUpdate('cascade');

            $table->uuid('job_type_id')->nullable();
            $table->foreign('job_type_id')->references('id')->on('job_types')->onDelete('set null')->onUpdate('cascade');

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
        Schema::dropIfExists('job_histories');
    }
}
