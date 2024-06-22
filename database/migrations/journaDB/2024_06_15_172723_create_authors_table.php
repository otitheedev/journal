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
        Schema::create('jdb_authors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('jdb_users')->onDelete('cascade');
            $table->foreignId('article_id')->constrained('jdb_articles')->onDelete('cascade');
            $table->string('contribution')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jdb_authors');
    }
};
