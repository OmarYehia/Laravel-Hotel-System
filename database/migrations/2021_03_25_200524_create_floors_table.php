<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFloorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('floors', function (Blueprint $table) {
            $table->id()->from(1000); // This auto_incremenets starting from 1000 (4 digits constraint)
            $table->string('floor_name');
            $table->unsignedBigInteger('floor_manager')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->foreign('floor_manager')->references('id')->on('users');
            $table->foreign('created_by')->references('id')->on('users');
            $table->timestamps();
        });
    }
}
