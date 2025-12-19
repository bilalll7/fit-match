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
        Schema::create('recommendations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade');

            $table->enum('type', ['daily', 'event', 'trend']);
            $table->enum('day', [
                'monday','tuesday','wednesday',
                'thursday','friday','saturday','sunday'
            ])->nullable();

            $table->string('title');
            $table->enum('source', ['user', 'platform', 'admin'])->default('user');

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recommendations');
    }
};
