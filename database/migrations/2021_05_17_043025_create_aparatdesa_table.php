<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAparatdesaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aparatdesa', function (Blueprint $table) {
            $table->id();
            $table->integer('wisata_id');
            $table->integer('pusat_id');
            $table->integer('masteraparat_id');
            $table->string('nama');
            $table->string('jenis_kelamin');
            $table->text('alamat');
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
        Schema::dropIfExists('aparatdesa');
    }
}
