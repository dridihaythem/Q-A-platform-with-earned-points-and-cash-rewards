<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->enum('provider', ['facebook', 'twitter', 'google'])->nullable();
            $table->string('provider_id')->nullable();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->string('avatar')->nullable();
            $table->integer('points')->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_admin')->default(false);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
