<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('country');
            $table->enum('gender', ['male', 'female']);
            $table->string('phone_number');
            $table->string('avatar_image')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->enum('approval_status', ['approved', 'pending', 'denied'])->default('pending');
            $table->foreign('approved_by')->references('id')->on('users');
            $table->date('last_login_date')->nullable();;
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
