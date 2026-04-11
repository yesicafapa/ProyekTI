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
    Schema::create('artikel', function (Blueprint $table) {
        $table->id();
        $table->string('judul', 512)->nullable();
        $table->text('ringkasan')->nullable();
        $table->text('isi')->nullable();
        $table->string('gambar', 255)->nullable();
        $table->tinyInteger('status')->nullable();
        $table->string('thumbnail', 255)->nullable();
        $table->timestamp('upload_at')->nullable();
        $table->timestamp('created_at')->useCurrent();
        $table->unsignedBigInteger('user_id')->nullable();
        $table->timestamp('updated_at')->nullable();

        // Relasi ke tabel user
        $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artikel');
    }
};
