<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('contacts')) {
            Schema::create('contacts', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email');
                $table->string('phone')->nullable();
                $table->string('company')->nullable();
                $table->string('budget')->nullable();
                $table->string('subject')->nullable();
                $table->text('message');
                $table->boolean('handled')->default(false);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('testimonials')) {
            Schema::create('testimonials', function (Blueprint $table) {
                $table->id();
                $table->string('author');
                $table->string('position')->nullable();
                $table->text('content');
                $table->string('company')->nullable();
                $table->string('avatar')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('testimonials');
        Schema::dropIfExists('contacts');
    }
};
