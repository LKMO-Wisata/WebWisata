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
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->string('order_code')->unique();
        $table->string('name');
        $table->string('email');
        $table->string('phone');
        $table->string('payment_method'); // e.g. 'transfer', 'qris', 'va'
        $table->unsignedInteger('amount'); // dalam rupiah
        $table->string('currency', 8)->default('IDR');
        $table->string('status')->default('paid'); // kita anggap langsung "paid" karena belum integrasi gateway
        $table->json('meta')->nullable(); // ruang fleksibel
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
