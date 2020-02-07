<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('name')->unique();

            $table->string('slug')->unique();

            $table->uuid('event_category_id')->nullable();
            $table->foreign('event_category_id')->references('id')->on('event_categories')->onDelete('set null')->onUpdate('cascade');

            $table->uuid('venue_id')->nullable();
            $table->foreign('venue_id')->references('id')->on('venues')->onDelete('set null')->onUpdate('cascade');

            $table->uuid('employee_id')->nullable();
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('set null')->onUpdate('cascade');

            $table->date('start_date')->nullable();

            $table->date('end_date')->nullable();

            $table->text('objectives')->nullable();


            $table->timestamps();
        });

        Schema::create('organisers', function (Blueprint $table) {
            $table->uuid('organization_id');
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade')->onUpdate('cascade');

            $table->uuid('event_id');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade')->onUpdate('cascade');

            $table->unique(['organization_id','event_id']);
        });

        Schema::create('facilitators', function (Blueprint $table) {

            $table->uuid('individual_id');
            $table->foreign('individual_id')->references('id')->on('individuals')->onDelete('cascade')->onUpdate('cascade');

            $table->uuid('event_id');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade')->onUpdate('cascade');

            $table->unique(['individual_id','event_id']);
        });


        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('organisers', function (Blueprint $table) {
            $table->dropForeign(['event_id']);
            $table->dropForeign(['organization_id']);
            $table->dropUnique(['organization_id','event_id']);
        });

        Schema::table('facilitators', function (Blueprint $table) {
            $table->dropForeign(['event_id']);
            $table->dropForeign(['individual_id']);
            $table->dropUnique(['individual_id','event_id']);
        });

        Schema::dropIfExists('events');
        Schema::dropIfExists('organisers');
        Schema::dropIfExists('facilitators');
    }
}
