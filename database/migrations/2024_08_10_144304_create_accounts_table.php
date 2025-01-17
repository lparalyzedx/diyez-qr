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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug');
            $table->string('logo')->nullable();
            $table->string('banner_image')->nullable();
            $table->string('placeholder_image')->nullable();
            $table->string('banner_logo')->nullable();
            $table->longText('adress')->nullable();
            $table->foreignId('city_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('district_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('map_url')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string( 'twitter')->nullable();
            $table->string('website')->nullable();
            $table->string('header_color')->nullable();
            $table->string('body_color')->nullable();
            $table->string('text_color')->nullable();
            $table->string('call_button_color')->nullable();
            $table->string('whatsapp_button_color')->nullable();
            $table->string('map_button_color')->nullable();
            $table->integer('logo_width')->default(100);
            $table->integer('category_logo_width')->default(100);
            $table->integer('owner_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamp('terminate_at')->default(now()->addDay(14));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
