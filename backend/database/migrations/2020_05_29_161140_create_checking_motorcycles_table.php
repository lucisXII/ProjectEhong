<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckingMotorcyclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checking_motorcycles', function (Blueprint $table) {
            $table->bigIncrements('cm_id');
            $table->unsignedBigInteger('m_id');
            $table->unsignedBigInteger('br_id');
            $table->unsignedBigInteger('user_id');
            $table->enum('status', ['0','1'])->default('1');
            $table->enum('unready', ['0','1','2'])->default('0');
            $table->string('comment')->nullable();
            $table->date('date');
            $table->foreign('m_id')->references('m_id')->on('motorcycles')->onDelete('cascade');
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
        Schema::dropIfExists('checking_motorcycles');
    }
}
