<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('event_id');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade')->onUpdate('cascade');

            $table->date('date');

            $table->uuid('individual_id');
            $table->foreign('individual_id')->references('id')->on('individuals')->onDelete('cascade')->onUpdate('cascade');

            $table->enum('participant_level',['L','I'])->default('L');

            $table->uuid('group_id')->nullable();
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('set null')->onUpdate('cascade');

            $table->uuid('participant_role_id')->nullable();
            $table->foreign('participant_role_id')->references('id')->on('participant_roles')->onDelete('set null')->onUpdate('cascade');

            $table->uuid('organization_id')->nullable();
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade')->onUpdate('cascade');

            $table->uuid('ward_id')->nullable();
            $table->foreign('ward_id')->references('id')->on('wards')->onDelete('set null')->onUpdate('cascade');

            $table->unique(['individual_id','event_id','date']);



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
        Schema::table('participants', function (Blueprint $table) {
            $table->dropForeign(['individual_id']);
            $table->dropForeign(['event_id']);
            $table->dropUnique(['individual_id','event_id','date']);
        });


        Schema::dropIfExists('participants');
    }
}
