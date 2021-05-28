<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onUpadate('restrict')->onDelete('cascade');
            $table->foreignId('type_project_id')->constrained('project_types')->onUpadate('restrict')->onDelete('cascade');
            $table->year('tahun_project');
            $table->string('nama_project');
            $table->string('nilai_pagu_project');
            $table->date('tgl_start');
            $table->date('tgl_finish');
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
        Schema::dropIfExists('projects');
    }
}
