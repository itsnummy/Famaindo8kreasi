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
        Schema::create('faktur_penjualan', function (Blueprint $table) {
            
            $table->string('no_transaksi', 50)->primary();           
            $table->string('kode_sales', 25)->nullable();
            $table->string('pelanggan', 50)->nullable(false);
            $table->text('alamat')->nullable();
            $table->string('kontak_wa', 20)->nullable();          
            $table->string('email', 25)->nullable();
            $table->text('item_pesanan')->nullable(false);
            $table->integer('harga_satuan')->length(10)->nullable(false);
            $table->integer('total_item')->length(10)->nullable(false);
            $table->string('kredit', 11)->nullable();
            $table->integer('total_akhir')->length(10)->nullable(false);          
            $table->string('potongan', 11)->nullable();
            $table->string('biaya_lain', 11)->nullable();
            $table->string('kembali', 11)->nullable();
            $table->string('tunai', 11)->nullable();
            $table->date('tanggal')->nullable(false);
            $table->date('tgl_jt')->nullable(false);
            $table->integer('subtotal')->length(10)->nullable(false);
            $table->text('keterangan')->nullable();
            $table->string('status', 20)->default('progress')->nullable();
            $table->string('K_Debit', 15)->nullable();
            $table->integer('DP_PO')->length(10)->nullable();
            $table->integer('jml')->length(10)->nullable();
            $table->string('K_Kredit', 15)->nullable();
            $table->integer('pajak')->length(10)->nullable();
            $table->text('terbilang')->nullable(false);


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faktur_penjualan');
    }
};
