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
        Schema::create('jdb_article_keywords', function (Blueprint $table) {
            $table->foreignId('article_id')->constrained('jdb_articles')->onDelete('cascade');
            $table->foreignId('keyword_id')->constrained('jdb_keywords')->onDelete('cascade');
            $table->primary(['article_id', 'keyword_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jdb_article_keywords');
    }
};
