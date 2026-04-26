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
    Schema::create('user', function (Blueprint $table) {
        $table->id();
        $table->string('nama', 100)->nullable();
        $table->string('email', 100)->nullable();
        $table->string('password', 60)->nullable();
        $table->enum('level', ['super admin', 'admin'])->nullable();
        $table->tinyInteger('status')->nullable();
        $table->timestamp('upload_at')->nullable();
        $table->timestamp('created_at')->useCurrent();
        $table->string('foto', 100)->nullable();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
