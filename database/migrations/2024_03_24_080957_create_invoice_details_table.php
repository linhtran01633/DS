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
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('invoice_id');
            $table->integer('product_id');
            $table->decimal('amount', 15)->default(0)->nullable();
            $table->smallInteger('quanty')->default(0)->nullable();
            $table->smallInteger('delete_flag')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_details');
    }
};
