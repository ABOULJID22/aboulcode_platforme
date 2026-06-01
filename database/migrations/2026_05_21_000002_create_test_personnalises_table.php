<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('test_personnalises', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();

            $table->string('test_name')->default('TestPersonnalise');
            $table->string('version')->default('1.0');
            $table->string('target_level')->nullable();
            $table->enum('status', ['draft', 'completed'])->default('draft');

            $table->json('answers')->nullable();
            $table->json('axis_scores')->nullable();
            $table->json('domain_scores')->nullable();
            $table->json('result_payload')->nullable();

            $table->string('primary_domain')->nullable();
            $table->string('secondary_domain')->nullable();
            $table->text('result_summary')->nullable();

            $table->timestamp('submitted_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('test_personnalises');
    }
};