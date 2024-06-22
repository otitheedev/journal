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
        Schema::create('jdb_articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug_url');
            $table->text('abstract');
            $table->date('submission_date');
            $table->date('publication_date')->nullable();
            $table->enum('status', ['1', '2', '3', '4']);
            $table->text('upload_pdf');
            $table->foreignId('journal_id')->constrained('jdb_journals')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('jdb_users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jdb_articles');
    }
};
