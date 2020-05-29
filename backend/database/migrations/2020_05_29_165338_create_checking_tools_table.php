<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckingToolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checking_tools', function (Blueprint $table) {
            $table->bigIncrements('ct_id');
            $table->unsignedBigInteger('tool_id');
            $table->unsignedBigInteger('br_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('remain');
            $table->integer('check');
            $table->string('comment')->nullable();
            $table->date('date');
            $table->foreign('tool_id')->references('tool_id')->on('tools')->onDelete('cascade');
            $table->foreign('br_id')->references('br_id')->on('branches')->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checking_tools');
    }
}
