<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmployeeIdToItemIssued extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_issued', function (Blueprint $table) {

            $table->enum('status',['O','R','I'])->nullable()->after('item_id');

            $table->integer('required')->nullable()->after('status');

            $table->uuid('employee_id')->nullable()->after('quantity');
            $table->foreign('employee_id')->references('id')->on('employees')->onUpdate('cascade')->onDelete('SET NULL');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item_issued', function (Blueprint $table) {
            $table->dropForeign(['employee_id']);
            $table->dropColumn(['employee_id']);
            $table->dropColumn(['status']);
            $table->dropColumn(['required']);
        });
    }
}
