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
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('position', 255);
            $table->float('salary_15')->default(0);
            $table->float('salary_30')->default(0);
            $table->float('overtime_15')->default(0);
            $table->float('overtime_30')->default(0);
            $table->float('allowance_15')->default(0);
            $table->float('allowance_30')->default(0);
            $table->float('month_13th_15')->default(0);
            $table->float('month_13th_30')->default(0);
            $table->float('manila_salary_15')->default(0);
            $table->float('manila_salary_30')->default(0);
            $table->float('manila_allowance_15')->default(0);
            $table->float('manila_allowance_30')->default(0);
            $table->float('manila_month_13th_15')->default(0);
            $table->float('manila_month_13th_30')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};
