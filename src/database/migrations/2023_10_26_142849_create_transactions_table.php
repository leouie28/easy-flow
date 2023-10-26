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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('model')->default('personal'); //personal or business
            $table->string('amount');
            $table->enum('type', ['income', 'expense']);
            $table->string('note')->nullable();
            $table->dateTime('date');
            $table->enum('form', ['cash', 'credit'])->default('cash');
            $table->string('save_type')->default('onine');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
