<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('outfit_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('outfit_id')
                ->constrained('outfits')
                ->cascadeOnDelete();

            $table->foreignId('category_id')
                ->constrained('categories')
                ->cascadeOnDelete();

            $table->string('image'); // foto item

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('outfit_items');
    }
};
