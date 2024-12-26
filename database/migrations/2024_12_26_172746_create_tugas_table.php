<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTugasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tugas', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('id_user'); // Foreign key ke tabel user
            $table->unsignedBigInteger('id_pekerjaan'); // Foreign key ke tabel pekerjaan
            $table->string('status')->default('pending'); // Status tugas (pending, in-progress, completed)
            $table->date('tanggal_mulai')->nullable(); // Tanggal mulai tugas
            $table->date('tanggal_selesai')->nullable(); // Tanggal selesai tugas
            $table->timestamps();

            // Relasi ke tabel users dan pekerjaan
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_pekerjaan')->references('id')->on('pekerjaans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tugas');
    }
}
