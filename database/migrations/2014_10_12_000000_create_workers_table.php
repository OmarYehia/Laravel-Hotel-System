<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('national_id')->unique();
            $table->string('avatar_image');
            $table->enum('role', ['admin', 'manager', 'receptionist']);
            $table->boolean('isBanned')->default(false);
            $table->unsignedBigInteger('created_by');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
