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
        Schema::create('book_inventories', function (Blueprint $table) {
            $table->id();
            $table->string("book_name")->nullable();
            $table->bigInteger("level_id")->nullable();
            $table->bigInteger("edition_id")->nullable();
            $table->integer("status_id")->nullable();
            $table->integer("quantity")->nullable();
            $table->integer("required_points")->nullable();
            $table->text("description")->nullable();
            $table->text("front_photo")->nullable();
            $table->text("back_photo")->nullable();
            $table->bigInteger("created_by")->nullable();
            $table->bigInteger("updated_by")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_inventories');
    }
};
