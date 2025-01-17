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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->json('slug');
            $table->json('contents')->nullable();
            $table->json('allergens')->nullable();
            $table->json('images')->nullable();
            $table->json('price');
            $table->json('currency');
            $table->json('variant_name_1')->nullable();
            $table->json('variant_price_1')->nullable();
            $table->json('variant_name_2')->nullable();
            $table->json('variant_price_2')->nullable();
            $table->json('variant_name_3')->nullable();
            $table->json('variant_price_3')->nullable();
            $table->json('variant_name_4')->nullable();
            $table->json('variant_price_4')->nullable();
            $table->json('variant_name_5')->nullable();
            $table->json('variant_price_5')->nullable();
            $table->json('variant_name_6')->nullable();
            $table->json('variant_price_6')->nullable();
            $table->json('variant_name_7')->nullable();
            $table->json('variant_price_7')->nullable();
            $table->json('variant_name_8')->nullable();
            $table->json('variant_price_8')->nullable();
            $table->json('variant_name_9')->nullable();
            $table->json('variant_price_9')->nullable();
            $table->json('variant_name_10')->nullable();
            $table->json('variant_price_10')->nullable();
            $table->json('variant_name_11')->nullable();
            $table->json('variant_price_11')->nullable();
            $table->json('variant_name_12')->nullable();
            $table->json('variant_price_12')->nullable();
            $table->json('variant_name_13')->nullable();
            $table->json('variant_price_13')->nullable();
            $table->json('variant_name_14')->nullable();
            $table->json('variant_price_14')->nullable();
            $table->json('variant_name_15')->nullable();
            $table->json('variant_price_15')->nullable();
            $table->integer('status')->default(1);
            $table->foreignId('categorie_id')->constrained()->cascadeOnDelete();
            $table->foreignId('account_id')->constrained()->cascadeOnDelete();
            $table->integer('order_id')->nullable();
            $table->boolean('import')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
