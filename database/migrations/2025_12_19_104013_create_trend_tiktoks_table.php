<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('trend_tiktoks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trend_id')
                  ->constrained('trends')
                  ->cascadeOnDelete();

            $table->string('tiktok_url');
            $table->string('creator_name')->nullable();
            $table->string('caption')->nullable();
            $table->string('thumbnail')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trend_tiktoks');
    }
};

