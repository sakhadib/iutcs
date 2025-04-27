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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('rules')->nullable();
            $table->string('start_date');
            $table->string('end_date')->nullable();
            $table->string('image')->nullable();
            $table->unsignedBigInteger('fest_id')->nullable();
            $table->timestamps();

            $table->foreign('fest_id')->references('id')->on('fests')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
