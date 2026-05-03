<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id(); 
            $table->string('nama', 50)->nullable(); 
            $table->string('email', 30)->nullable(); 
            $table->string('password', 60)->nullable(); 
            $table->enum('level', ['super admin', 'admin'])->nullable(); 
            $table->tinyInteger('status')->nullable(); 
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->string('foto', 100)->nullable(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};