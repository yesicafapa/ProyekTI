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
        Schema::create('testimoni', function (Blueprint $table) {
            // id_testimoni di diagram adalah primary key
            $table->id(); 
            
            $table->string('pengguna', 100)->nullable();
            $table->string('deskripsi', 512)->nullable();
            $table->tinyInteger('status')->nullable();
            $table->string('image_pengguna', 255)->nullable();
            
            // Kolom timestamp sesuai diagram
            $table->timestamp('upload_at')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();

            // Relasi ke tabel user
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimoni');
    }
};