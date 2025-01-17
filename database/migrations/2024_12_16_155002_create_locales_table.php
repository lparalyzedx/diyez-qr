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
        Schema::create('locales', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('language_code');
            $table->string('flag');
            $table->boolean('is_default')->default(false);
            $table->boolean('status')->default(true);
            $table->foreignId('account_id')->nullable()->constrained()->cascadeOnDelete();
            $table->unique(['account_id', 'language_code']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locales');
    }
};
