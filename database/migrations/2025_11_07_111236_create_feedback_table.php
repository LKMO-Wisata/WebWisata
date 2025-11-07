<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->string('email', 190);
            $table->string('name', 150)->nullable();
            $table->unsignedTinyInteger('rating')->default(0); // 0..5
            $table->text('message');
            $table->ipAddress('ip')->nullable();
            $table->text('agent')->nullable();
            $table->timestamps();

            $table->index(['rating', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
