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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id(); // bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT
            
            $table->string('nama', 255); // varchar(255)
            $table->string('email', 255); // varchar(255)
            $table->string('telepon', 255); // varchar(255)
            $table->text('alamat'); // text
            $table->text('pesan'); // text
            
            // tinyint(1) NOT NULL DEFAULT 0
            $table->tinyInteger('is_responded')->default(0); 
            
            // Mencakup created_at dan updated_at
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};