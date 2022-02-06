<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacs', function (Blueprint $table) {
            $table->id('id');
            $table->string('post');
            $table->string('type');
            $table->mediumInteger('salary');
            $table->smallInteger('amount');
            $table->bigInteger('external_id')->nullable();
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
        Schema::dropIfExists('vacs');
    }
}
