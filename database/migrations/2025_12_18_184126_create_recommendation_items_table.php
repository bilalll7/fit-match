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
        Schema::create('recommendation_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('recommendation_id')
                ->constrained()
                ->onDelete('cascade');

            $table->enum('category', ['top', 'bottom', 'shoes', 'accessory']);
            $table->string('name');
            $table->string('image');

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recommendation_items');
    }
};
