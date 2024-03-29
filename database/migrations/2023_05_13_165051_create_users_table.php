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
            $table->integer('id')->primary();
            $table->text('email')->unique();
            $table->text('password');
            $table->text('first_name');
            $table->text('last_name');
            $table->date('birth_date');
            $table->date('expire_at')->nullable();
            $table->text('registration_token')->nullable();
            $table->boolean('admin');
            $table->date('created_at');
            $table->date('updated_at');
            $table->text('remember_token')->nullable();
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
