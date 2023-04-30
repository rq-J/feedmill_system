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
        Schema::create('item_dailies_report', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_formula_id');
            $table->foreign('item_formula_id')->references('id')->on('item_formulas');
            $table->string('price_per_kgs');
            $table->string('inventory_cost');
            $table->string('kgs_per_bag');
            $table->string('begin_inventory_kgs');
            $table->string('deliveries_today');
            $table->string('deliveries_todate');
            $table->string('usage_today');
            $table->string('usage_todate');
            $table->string('end_inventory_kgs');
            $table->string('end_inventory_bags');
            $table->string('number_of_working');
            $table->string('average_usage');
            $table->string('number_of_days');
            $table->string('actual_count_bags');
            $table->string('actual_count_kgs');
            $table->string('actual_count_total');
            $table->string('actual_count_diff');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_dailies_report');
    }
};
