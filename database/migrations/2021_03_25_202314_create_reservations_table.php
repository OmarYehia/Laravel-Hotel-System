<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('room_id')->nullable();  //nullable added to test only, refrential integrity will be dealth with with the main code
            $table->unsignedBigInteger('client_id')->nullable(); //nullable added to test only, refrential integrity will be dealth with with the main code
            $table->integer('paid_price');
            $table->integer('accompany_number');
            $table->date('reservation_date');
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('set null');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('set null');
            $table->timestamps();
        });
    }
}
