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
            $table->string('name');
            $table->string('slug');
            $table->text('contents')->nullable();
            $table->text('allergens')->nullable();
            $table->json('images')->nullable();
            $table->decimal('price',8,2)->default(0);
            $table->string('currency')->default('₺');
            $table->string('variant_name_1')->nullable();
            $table->decimal('variant_price_1',8,2)->nullable();
            $table->string('variant_name_2')->nullable();
            $table->decimal('variant_price_2',8,2)->nullable();
            $table->string('variant_name_3')->nullable();
            $table->decimal('variant_price_3',8,2)->nullable();
            $table->string('variant_name_4')->nullable();
            $table->decimal('variant_price_4',8,2)->nullable();
            $table->string('variant_name_5')->nullable();
            $table->decimal('variant_price_5',8,2)->nullable();
            $table->string('variant_name_6')->nullable();
            $table->decimal('variant_price_6',8,2)->nullable();
            $table->string('variant_name_7')->nullable();
            $table->decimal('variant_price_7',8,2)->nullable();
            $table->string('variant_name_8')->nullable();
            $table->decimal('variant_price_8',8,2)->nullable();
            $table->string('variant_name_9')->nullable();
            $table->decimal('variant_price_9',8,2)->nullable();
            $table->string('variant_name_10')->nullable();
            $table->decimal('variant_price_10',8,2)->nullable();
            $table->string('variant_name_11')->nullable();
            $table->decimal('variant_price_11',8,2)->nullable();
            $table->string('variant_name_12')->nullable();
            $table->decimal('variant_price_12',8,2)->nullable();
            $table->string('variant_name_13')->nullable();
            $table->decimal('variant_price_13',8,2)->nullable();
            $table->string('variant_name_14')->nullable();
            $table->decimal('variant_price_14',8,2)->nullable();
            $table->string('variant_name_15')->nullable();
            $table->decimal('variant_price_15',8,2)->nullable();
            $table->integer('status')->default(1);
            $table->boolean('import')->default(false);
            $table->foreignId('categorie_id')->constrained()->cascadeOnDelete();
            $table->foreignId('account_id')->constrained()->cascadeOnDelete();
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
