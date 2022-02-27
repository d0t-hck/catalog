<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\DocBlock\Tags\Reference\Reference;

class CreateTitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('titles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('status_code');
            $table->foreign('status_code')->references('code')->on('statuses')->onDelete('set null');
            $table->integer('release_year')->default(DB::raw('extract(year from current_date)'));
            $table->text('description');
            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('artist_id');
            $table->unsignedBigInteger('publisher_id');
            $table->foreign('author_id')->references('id')->on('creators')->onDelete('cascade');
            $table->foreign('artist_id')->references('id')->on('creators')->onDelete('cascade');
            $table->foreign('publisher_id')->references('id')->on('creators')->onDelete('cascade');
            $table->string('normalized_name');
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
        Schema::dropIfExists('titles');
    }
}
