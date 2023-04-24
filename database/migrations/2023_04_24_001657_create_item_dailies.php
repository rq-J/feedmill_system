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
        Schema::create('item_dailies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_formula_id');
            $table->foreign('item_formula_id')->references('id')->on('item_formulas');
            $table->float('batch')->default(0);
            $table->float('total_batch')->default(0);
            $table->float('adjustment')->default(0);
            $table->float('usage')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_dailies');
    }
};
