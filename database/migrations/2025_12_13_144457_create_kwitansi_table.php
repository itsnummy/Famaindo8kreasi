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
        Schema::create('kwitansi', function (Blueprint $table) {
            
            $table->id(); 
            $table->string('no_transaksi', 50)->nullable(false); 
            $table->string('sejumlah', 20)->nullable(false); 
            $table->text('utk_pembayaran')->nullable(false); 
            $table->tinyInteger('jenis')->length(1)->nullable(false); 
            $table->foreign('no_transaksi')
                  ->references('no_transaksi') 
                  ->on('faktur_penjualan')    
                  ->onDelete('cascade');     

            // Kolom waktu standar
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kwitansi');
    }
};