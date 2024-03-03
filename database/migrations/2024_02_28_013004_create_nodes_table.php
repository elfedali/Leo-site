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
        Schema::disableForeignKeyConstraints();

        Schema::create('nodes', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->foreignId('owner_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('content')->nullable();
            $table->text('excerpt')->nullable();

            $table->string('status')->default(\App\Core\Constants::NODE_STATUS_DRAFT);
            $table->string('type')->default(\App\Core\Constants::NODE_TYPE_RESTAURANT);

            // reservation
            $table->string('reservation_required')->default(\App\Core\Constants::NODE_RESERVATION_NOT_REQUIRED);
            $table->text('reservation_note')->nullable();
            // review
            $table->text('review_note')->nullable();
            $table->string('review_status')->default(\App\Core\Constants::NODE_REVIEW_STATUS_OPEN);

            $table->string('phone')->nullable();
            $table->string('phone_secondary')->nullable();
            $table->string('phone_tertiary')->nullable();

            $table->string('email')->nullable();

            $table->string('address')->nullable();

            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();

            $table->time('open_time')->nullable();
            $table->time('close_time')->nullable();

            $table->decimal('price_from', 10, 2)->nullable();
            $table->decimal('price_to', 10, 2)->nullable();

            $table->boolean('recommended')->default(false);
            $table->boolean('featured')->default(false);

            $table->string('currency')->default('MAD');
            $table->integer('capacity')->default(0);
            $table->decimal('rating', 2, 1)->default(0);


            $table->string('website')->nullable();

            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->string('tiktok')->nullable();



            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nodes');
    }
};
