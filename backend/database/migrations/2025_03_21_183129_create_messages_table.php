<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();

            // The sender (assuming each message is sent by a user)
            $table->foreignId('sender_id')->constrained('users')->cascadeOnDelete();

            // The recipient (the user who is receiving the message)
            $table->foreignId('recipient_id')->constrained('users')->cascadeOnDelete();

            // If you want a relationship to listings (e.g., messages about a particular listing)
            // $table->foreignId('listing_id')->nullable()->constrained()->cascadeOnDelete();

            // The actual text/body of the message
            $table->text('body');

            // e.g., whether the recipient has read the message
            $table->boolean('is_read')->default(false);

            // Standard timestamps (created_at, updated_at)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('messages');
    }
};
