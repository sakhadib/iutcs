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
        Schema::create('event_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');
            $table->string('image_path'); // Path to the image file
            $table->string('original_name')->nullable(); // Original filename when uploaded
            $table->string('alt_text')->nullable(); // Alt text for accessibility
            $table->text('caption')->nullable(); // Optional caption for the image
            $table->integer('sort_order')->default(0); // For ordering images
            $table->boolean('is_featured')->default(false); // Mark if this is a featured image
            $table->timestamps();

            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->index('event_id');
            $table->index(['event_id', 'sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_images');
    }
};
