<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubheadingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subheadings', function (Blueprint $table) {
            $table->bigIncrements('sh_id');
            $table->unsignedBigInteger('hd_id');
            $table->string('subheadingName');
            $table->integer('score');
            $table->foreign('hd_id')->references('hd_id')->on('headings')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subheadings');
    }
}
