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
        Schema::create('weekly_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('farm_location_id');
            $table->foreign('farm_location_id')->references('id')->on('farm_locations');
            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')->references('id')->on('items');
            $table->float('age_or_stage')->default(0);
            $table->float('population')->default(0);
            $table->float('grams_per_population')->default(0);
            $table->float('total_request')->default(0);
            $table->float('monday')->default(0);
            $table->float('tuesday')->default(0);
            $table->float('wenesday')->default(0);
            $table->float('thursday')->default(0);
            $table->float('friday')->default(0);
            $table->float('saturday')->default(0);
            $table->boolean('active_status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weekly_requests');
    }
};
