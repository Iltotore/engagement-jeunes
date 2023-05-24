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
        Schema::create('references', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('user_id');
            $table->text('description');
            $table->text('area');
            $table->text('hard_skill_values')->default('');
            $table->text('soft_skill_values')->default('');
            $table->date('duration')->nullable();
            $table->text('ref_first_name');
            $table->text('ref_last_name');
            $table->date('ref_birth_date');
            $table->text('ref_mail');
            $table->boolean('validated')->default(false);
            $table->date('expire_at')->nullable();
            $table->date('updated_at')->nullable();
            $table->date('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('references');
    }
};
