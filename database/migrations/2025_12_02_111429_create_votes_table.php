<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('item_id')->constrained()->cascadeOnDelete();
            $table->tinyInteger('value'); // 1 for upvote, -1 for downvote
            $table->timestamps();

            $table->unique(['user_id', 'item_id']); // One vote per user per item
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
