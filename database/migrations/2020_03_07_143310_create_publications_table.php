<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');

            $table->uuid('author_id')->nullable();
            $table->foreign('author_id')->references('id')->on('authors')->onDelete('set null')->onUpdate('cascade');

            $table->uuid('publisher_id')->nullable();
            $table->foreign('publisher_id')->references('id')->on('publishers')->onDelete('set null')->onUpdate('cascade');

            $table->uuid('genre_id')->nullable();
            $table->foreign('genre_id')->references('id')->on('genres')->onDelete('set null')->onUpdate('cascade');

            $table->unsignedInteger('year')->nullable();

            $table->uuid('publication_category_id')->nullable();
            $table->foreign('publication_category_id')->references('id')->on('publication_categories')->onDelete('set null')->onUpdate('cascade');

            $table->uuid('shelf_id')->nullable();
            $table->foreign('shelf_id')->references('id')->on('shelves')->onDelete('set null')->onUpdate('cascade');

            $table->unsignedDecimal('class_number')->nullable();

            $table->text('desc')->nullable();

            $table->unique(['title','author_id']);

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
        Schema::dropIfExists('publications');
    }
}
