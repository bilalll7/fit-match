<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('outfits', function (Blueprint $table) {
            $table->enum('type', ['daily', 'event', 'trend'])
                  ->after('image');

            $table->enum('source', ['user', 'platform', 'admin'])
                  ->after('type');
        });
    }

    public function down(): void
    {
        Schema::table('outfits', function (Blueprint $table) {
            $table->dropColumn(['type', 'source']);
        });
    }
};
