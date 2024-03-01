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
        Schema::create('inventory_data_values', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('inventory_data_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('inventory_data_id');
            $table->unsignedBigInteger('inventory_field_id');
            $table->float('number_value')->nullable();
            $table->boolean('boolean_value')->nullable();
            $table->date('date_value')->nullable();
            $table->longText('text_value')->nullable();
            $table->json('json_value')->nullable();
            $table->unsignedBigInteger('relation_value')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_data_values');
    }
};
