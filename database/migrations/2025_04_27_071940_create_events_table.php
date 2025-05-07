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
            $table->string('rulebook-link')->nullable();
            $table->text('prizes')->nullable();
            $table->text('judges')->nullable();
            $table->string('registration_link')->nullable();
            $table->text('contact')->nullable();
            $table->text('medium')->nullable(); // online, offline
            $table->text('location')->nullable(); // location of the event
            $table->string('registration_fee')->nullable();
            $table->string('max_team_size')->nullable();
            $table->string('min_team_size')->nullable();
            $table->dateTime('registration_closing_date')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
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
