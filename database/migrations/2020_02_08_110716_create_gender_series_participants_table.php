<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenderSeriesParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gender_series_participants', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('gender_series_id')->nullable();
            $table->foreign('gender_series_id')->references('id')->on('gender_series')->onDelete('set null')->onUpdate('cascade');

            $table->uuid('individual_id')->nullable();
            $table->foreign('individual_id')->references('id')->on('individuals')->onDelete('set null')->onUpdate('cascade');

            $table->uuid('organization_id')->nullable();
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('set null')->onUpdate('cascade');

            $table->uuid('ward_id')->nullable();
            $table->foreign('ward_id')->references('id')->on('wards')->onDelete('set null')->onUpdate('cascade');

            $table->unique(['individual_id','gender_series_id']);

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
        Schema::table('gender_series_participants', function (Blueprint $table) {
            $table->dropForeign(['individual_id']);
            $table->dropForeign(['gender_series_id']);
            $table->dropForeign(['organization_id']);
            $table->dropForeign(['ward_id']);

            $table->dropUnique(['individual_id','gender_series_id']);
        });

        Schema::dropIfExists('gender_series_participants');
    }
}
