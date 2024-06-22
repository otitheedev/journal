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
        Schema::create('jdb_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_id')->constrained('jdb_articles')->onDelete('cascade');
            $table->foreignId('reviewer_id')->constrained('jdb_users')->onDelete('cascade');
            $table->date('review_date');
            $table->text('comments');
            $table->enum('recommendation', ['1', '2', '3', '4']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jdb_reviews');
    }
};
