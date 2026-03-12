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
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('shopkeeper_id')->constrained('users')->onDelete('cascade');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->text('message');
            $table->enum('sender_type', ['customer', 'shopkeeper']);
            $table->boolean('is_read')->default(false);
            $table->timestamps();
            
            $table->index(['customer_id', 'shopkeeper_id']);
            $table->index(['shopkeeper_id', 'is_read']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
