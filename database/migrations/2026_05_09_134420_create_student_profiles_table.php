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
        Schema::create('student_profiles', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            
            // Étape 1 - Informations Académiques
            $table->string('education_level')->nullable(); // 1ère année Bac, 2ème année Bac, BAC+1, etc.
            $table->enum('bac_type', ['marocain', 'mission'])->nullable(); // Marocain / Mission
            $table->string('bac_field')->nullable(); // Sciences Physiques, etc.
            $table->string('school_name')->nullable();
            $table->enum('school_type', ['public', 'private'])->nullable();
            
            // Étape 2 - Préférences d'Études
            $table->json('preferred_school_types')->nullable(); // ['public', 'private', 'military', 'semi-public']
            $table->json('interested_services')->nullable(); // ['orientation_session', 'school_registration', 'notifications']
            
            // Étape 3 - Informations Personnelles (some auto-filled from user)
            $table->date('birth_date')->nullable();
            $table->enum('gender', ['masculine', 'feminine'])->nullable();
            $table->string('city')->nullable();
            
            // Étape 4 - Accord de Contact
            $table->boolean('consent_contact')->default(false);
            
            // Configuration status
            $table->boolean('is_complete')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_profiles');
    }
};
