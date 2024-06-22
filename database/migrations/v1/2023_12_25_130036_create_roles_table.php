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
        Schema::create('core_roles', function (Blueprint $table) {
            $table->id();
            $table->string('role_custom_name'); 
            $table->string('role_name'); 
            $table->bigInteger('level');
            $table->timestamps();
        });

        Schema::create('core_role_user', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('role_id');
            
            // Define foreign keys
            $table->foreign('user_id')->references('id')->on('jdb_users')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('core_roles')->onDelete('cascade'); // corrected table name
            
            // Define unique combination of user_id and role_id
            $table->unique(['user_id', 'role_id']);
            
            // Indexes
            $table->index(['user_id', 'role_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('core_role_user');
        Schema::dropIfExists('core_roles');
    }
};
