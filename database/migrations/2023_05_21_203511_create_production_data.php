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
        Schema::create('production_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_id')->nullable();
            $table->foreign('item_id')->references('id')->on('items');
            $table->unsignedBigInteger('farm_id')->nullable();
            $table->foreign('farm_id')->references('id')->on('farms');

            $table->time('runtime_start')->nullable();
            $table->time('runtime_end')->nullable();
            $table->float('cycle_time')
                ->nullable();
            $table->float('tons_produced')
                ->nullable();
            $table->float('tons_per_hour')
                ->nullable();
            $table->float('target_tons_per_hour')
                ->nullable();
            $table->float('production_target_tons')
                ->nullable();

            $table->unsignedBigInteger('quality_assurance_id')->nullable();
            $table->foreign('quality_assurance_id')
                ->references('id')
                ->on('quality_assurances');

            $table->unsignedBigInteger('downtime_id')->nullable();
            $table->foreign('downtime_id')
                ->references('id')
                ->on('downtimes');
            $table->time('downtime_start');
            $table->time('downtime_end');
            $table->float('downtime_hour')
                ->default(0);

            $table->float('total_hours_operated')
                ->default(0);
            $table->integer('number_of_manpower')
                ->default(0);

            $table->string('remarks')->nullable();

            $table->boolean('active_status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('production_data');
    }
};
