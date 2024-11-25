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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->text('book_title')->nullable();
            $table->bigInteger('book_id')->nullable();
            $table->bigInteger('level_id')->nullable();
            $table->bigInteger('edition_id')->nullable();
            $table->bigInteger('condition_id')->nullable();
            $table->text('front_photo')->nullable();
            $table->text('back_photo')->nullable();
            $table->integer('book_points')->nullable();
            $table->text('description')->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
