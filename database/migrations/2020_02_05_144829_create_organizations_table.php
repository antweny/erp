<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name',191)->unique();
            $table->string('slug',191)->unique();
            $table->string('acronym',15)->nullable();
            $table->integer('founded')->nullable();
            $table->integer('registered')->nullable();

            $table->uuid('organization_category_id')->nullable();
            $table->foreign('organization_category_id')->references('id')->on('organization_categories')->onDelete('set null')->onUpdate('cascade');

            $table->enum('operation_level', ['CL','DL','REL','NL','RL','IL'])->nullable();

            $table->uuid('city_id')->nullable();
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('set null')->onUpdate('cascade');

            $table->uuid('district_id')->nullable();
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('set null')->onUpdate('cascade');

            $table->uuid('ward_id')->nullable();
            $table->foreign('ward_id')->references('id')->on('wards')->onDelete('set null')->onUpdate('cascade');

            $table->string('contact_person',50)->nullable();
            $table->string('contact_person_number',20)->nullable();
            $table->mediumText('address')->nullable();
            $table->string('website')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile',15)->nullable();
            $table->string('phone',15)->nullable();
            $table->text('objectives')->nullable();

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
        Schema::dropIfExists('organizations');
    }
}
