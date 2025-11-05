<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('wahana', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 150);
            $table->string('slug', 180)->unique();
            $table->text('deskripsi')->nullable();
            $table->json('ketentuan')->nullable(); // simpan array string
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wahana');
    }
};
