<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('academic_diagnostics', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();

            // Academic Information
            $table->string('macro_cycle');
            $table->string('academic_level');
            $table->string('interest_theme')->nullable();
            $table->string('track_branch')->nullable();
            $table->string('institution_type')->nullable();
            $table->string('specialty_family')->nullable();
            $table->string('specialty_label')->nullable();
            $table->string('biof_language')->nullable();
            $table->text('remark')->nullable();

            // Test Status & Results
            $table->enum('status', ['draft', 'completed'])->default('draft');
            $table->string('result_code')->nullable();
            $table->string('result_label')->nullable();
            $table->text('result_summary')->nullable();
            $table->json('result_payload')->nullable();

            // Timestamps
            $table->timestamp('submitted_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('academic_diagnostics');
    }
};
