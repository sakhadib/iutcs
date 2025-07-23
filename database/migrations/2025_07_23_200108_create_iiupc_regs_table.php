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
        Schema::create('iiupc_regs', function (Blueprint $table) {
            $table->id();
            $table->string('team_name');

            //person 1
            $table->string('member1_name');
            $table->string('member1_email');
            $table->string('member1_student_id');
            $table->string('member1_department');
            $table->string('member1_program');
            $table->string('member1_batch')->nullable(); // Optional field for batch information
            $table->string('member1_phone')->nullable(); // Optional field for phone number

            //person 2
            $table->string('member2_name')->nullable();
            $table->string('member2_email')->nullable();
            $table->string('member2_student_id')->nullable();
            $table->string('member2_department')->nullable();
            $table->string('member2_program')->nullable();
            $table->string('member2_batch')->nullable(); // Optional field for batch information
            $table->string('member2_phone')->nullable(); // Optional field for phone number

            //person 3
            $table->string('member3_name')->nullable();
            $table->string('member3_email')->nullable();
            $table->string('member3_student_id')->nullable();
            $table->string('member3_department')->nullable();
            $table->string('member3_program')->nullable();
            $table->string('member3_batch')->nullable(); // Optional field for batch information
            $table->string('member3_phone')->nullable(); // Optional field for phone number

            //payment information
            $table->string('transaction_id')->nullable(); // Transaction ID for payment tracking

            //registration token
            $table->string('registration_token', 6)->unique(); // 6-character 

            // registration status
            $table->enum('registration_status', ['pending', 'verified', 'removed'])->default('pending'); // removed for soft delete functionality

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iiupc_regs');
    }
};
