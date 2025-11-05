<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('wahana_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wahana_id')->constrained('wahana')->cascadeOnDelete();
            $table->string('path'); // 'fotos/..' (storage) atau 'img/wahana/...' (public asset lama)
            $table->unsignedInteger('ordering')->default(0);
            $table->boolean('is_primary')->default(false);
            $table->timestamps();

            $table->index(['wahana_id', 'is_primary']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wahana_photos');
    }
};
