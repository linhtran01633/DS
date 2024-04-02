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
        Schema::create('invoices', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('date', 10)->nullable();
            $table->string('name_from', 256)->nullable();
            $table->string('phone_from', 15)->nullable();
            $table->string('email_from', 256)->nullable();
            $table->string('name_to', 256)->nullable();
            $table->string('phone_to', 15)->nullable();
            $table->string('name_city', 256)->nullable();
            $table->string('name_district', 256)->nullable();
            $table->string('name_ward', 256)->nullable();
            $table->string('address_to', 512)->nullable();
            $table->string('note_to', 512)->nullable();
            $table->decimal('amount', 15,0)->default(0)->nullable();
            $table->integer('user_id')->nullable();
            $table->smallInteger('invoice_flag')->default(0)->nullable();
            $table->smallInteger('delete_flag')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
