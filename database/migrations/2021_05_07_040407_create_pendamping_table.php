<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendampingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendamping', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('pusat_id');
            $table->string('nama_pendamping');
            $table->string('notelp');
            $table->text('alamat');
            $table->string('ktp');
            $table->integer('status');
            $table->string('foto');
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
        Schema::dropIfExists('pendamping');
    }
}
