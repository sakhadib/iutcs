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
        Schema::create('registration_question_fields', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->string('type'); // text, select
            $table->string('options')->nullable(); // comma separated values for select type
            $table->unsignedBigInteger('event_id')->nullable();
            $table->timestamps();

            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registration_question_fields');
    }
};
