<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();

            // The user who wrote the review
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // The listing being reviewed
            $table->foreignId('listing_id')->constrained()->cascadeOnDelete();

            // Rating (e.g., a star rating)
            $table->tinyInteger('rating'); // typically 1-5

            // The text review
            $table->text('comment')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reviews');
    }
};
