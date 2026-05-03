<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id(); 
            $table->string('nama', 50)->nullable(); 
            $table->string('email', 30)->nullable(); 
            $table->string('telepon', 15)->nullable(); 
            $table->string('alamat', 120)->nullable(); 
            $table->text('pesan')->nullable(); 
            $table->tinyInteger('is_responded')->nullable(); 
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};