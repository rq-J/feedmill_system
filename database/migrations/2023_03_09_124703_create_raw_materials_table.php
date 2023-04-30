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
        Schema::create('raw_materials', function (Blueprint $table) {
            $table->id();
            $table->string('raw_material_name', 255);
            $table->integer('price_per_kgs');
            $table->integer('inventory_cost');
            $table->integer('kgs_per_bag');
            $table->integer('standard_days');
            $table->string('category', 30);
            $table->boolean('active_status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raw_materials');
    }
};
