<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->integer('room_number')->unique();
            $table->integer('room_price');
            $table->integer('room_capacity');
            $table->unsignedBigInteger('floor_id');
            $table->unsignedBigInteger('created_by');
            $table->boolean('is_reserved')->default(false);
            $table->foreign('floor_id')->references('id')->on('floors');
            $table->foreign('created_by')->references('id')->on('workers');
            $table->timestamps();
        });
    }
}
