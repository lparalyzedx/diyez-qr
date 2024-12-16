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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->nullable();
            $table->text('site_description')->nullable();
            $table->string('logo')->nullable();
            $table->string('logo_small')->nullable();
            $table->string('email')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->longText('user_agreement')->nullable();
            $table->longText('lighting_text')->nullable();
            $table->longText('privacy_policy')->nullable();
            $table->longText('cookie_policy')->nullable();
            $table->string('android_app_id')->nullable();
            $table->string('ios_app_id')->nullable();
            $table->string('version')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
