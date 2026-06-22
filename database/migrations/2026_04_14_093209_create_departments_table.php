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
        Schema::create('departments', function (Blueprint $table) {
            $table->id('departmentID');
            $table->string('departmentName')->unique();

            // FK ke employees (manager)
            $table->unsignedBigInteger('departmentManagerID')->nullable();

            $table->foreign('departmentManagerID')
                  ->references('employeeID')
                  ->on('employees')
                  ->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
