<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDukunganIdToProgramsTable extends Migration
{
    public function up()
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->unsignedBigInteger('dukungan_id')->nullable()->after('facility_id'); // tambahkan kolom
            $table->foreign('dukungan_id')->references('id')->on('dukungans')->onDelete('set null'); // relasi fk opsional
        });
    }

    public function down()
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->dropForeign(['dukungan_id']);
            $table->dropColumn('dukungan_id');
        });
    }
}
