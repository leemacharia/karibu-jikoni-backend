<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations to create the preferences table.
     */
    public function up(): void
    {
        Schema::create('preferences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Links to users table, deletes preferences on user deletion
            $table->string('dietary_preference')->default('none'); // Options: none, vegetarian, vegan, gluten-free
            $table->string('delivery_frequency')->default('weekly'); // Options: daily, weekly, monthly
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations by dropping the preferences table.
     */
    public function down(): void
    {
        Schema::dropIfExists('preferences');
    }
};