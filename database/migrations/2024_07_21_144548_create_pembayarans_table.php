<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('toko_id')->constrained('tokos');
            $table->foreignId('service_id')->constrained('services');
            $table->string('invoice_code')->nullable();
            $table->string('nama')->nullable();
            $table->string('waktu')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('alamat')->nullable();
            $table->string('patokan')->nullable();
            $table->string('kec')->nullable();
            $table->string('kel')->nullable();
            $table->string('prov')->nullable();
            $table->string('user_lat')->nullable();
            $table->string('user_long')->nullable();
            $table->integer('jumlah_pesanan')->nullable();
            $table->date('tanggal_booking')->nullable();
            $table->integer('total_bayar')->nullable();
            $table->string('status')->nullable();
            $table->string('status_pesanan')->nullable();
            $table->string('konfirmasi')->nullable();
            $table->string('status_pencairan')->nullable();
            $table->string('bukti_pencairan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
