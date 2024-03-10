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
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->foreignId('owner_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('category_id')->constrained('menu_categories')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('title');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->string('currency')->default('MAD');
            $table->boolean('recommended')->default(false);
            $table->boolean('featured')->default(false);
            $table->string('image')->nullable();
            $table->string('status')->default(\App\Core\Constants::NODE_STATUS_DRAFT);
            $table->integer('position')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
