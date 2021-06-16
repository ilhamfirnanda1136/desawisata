<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAlamatToAparatdesa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('aparatdesa', function (Blueprint $table) {
            $table->string('email', 100);
            $table->string('notelp', 15);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('aparatdesa', function (Blueprint $table) {
            $table->dropColumn(['email', 'notelp']);
        });
    }
}
