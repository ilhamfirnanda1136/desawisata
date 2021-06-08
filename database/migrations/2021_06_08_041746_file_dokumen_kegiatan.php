<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FileDokumenKegiatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_dokumen_kegiatan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dokumen_kegiatan_id')->constrained('dokumen_kegiatan')->onUpadate('restrict')->onDelete('cascade');
            $table->string('filename');
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
        Schema::dropIfExists('file_dokumen_kegiatan');
    }
}
