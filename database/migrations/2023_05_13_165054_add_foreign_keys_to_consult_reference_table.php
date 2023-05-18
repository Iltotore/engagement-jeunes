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
        Schema::table('consult_reference', function (Blueprint $table) {
            $table->foreign(['consult_id'], 'consult_references_consults_id_fk')->references([])->on('consults')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['reference_id'], 'consult_references_references_id_fk')->references([])->on('references')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('consult_reference', function (Blueprint $table) {
            $table->dropForeign('consult_references_consults_id_fk');
            $table->dropForeign('consult_references_references_id_fk');
        });
    }
};
