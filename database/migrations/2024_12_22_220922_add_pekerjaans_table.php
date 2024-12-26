<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPekerjaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pekerjaans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_lokasi'); // Foreign key ke tabel lokasis
            $table->string('nama_pekerjaan');
            $table->decimal('nominal', 15, 2)->default(0); // Kolom nominal dengan tipe decimal
            $table->text('deskripsi')->nullable();
            $table->timestamps();

            // Relasi ke tabel lokasis
            $table->foreign('id_lokasi')->references('id')->on('lokasis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pekerjaans');
    }
};