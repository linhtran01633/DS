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
        Schema::create('products', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('category_id');
            $table->string('name', 256)->nullable();
            $table->string('brand', 256)->nullable();
            $table->decimal('price', 15)->default(0)->nullable();
            $table->string('quantity', 256)->nullable();
            $table->string('image', 256)->nullable();
            $table->string('title', 256)->nullable();
            $table->string('title_detail', 2024)->nullable();
            $table->smallInteger('delete_flag')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
