<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// return new class extends Migration
// {
//     /**
//      * Run the migrations.
//      */
//     public function up(): void
//     {
//         Schema::table('employees', function (Blueprint $table) {
//             //
//         });
//     }

//     /**
//      * Reverse the migrations.
//      */
//     public function down(): void
//     {
//         Schema::table('employees', function (Blueprint $table) {
//             //
//         });
//     }
// };

return new class extends Migration {
    public function up(): void
    {
        // Drop users table if it exists
        Schema::dropIfExists('users');
        
        // Create employees table with proper structure
        Schema::create('employees', function (Blueprint $table) {
            $table->id('employeeID');
            $table->string('employeeName');
            $table->string('employeeEmail')->unique();
            $table->string('employeePassword');
            $table->string('employeePhone')->nullable();
            $table->string('employeePicture')->nullable();
            $table->string('role')->default('employee');
            $table->unsignedBigInteger('departmentID')->nullable();
            $table->unsignedBigInteger('supervisorID')->nullable();
            
            $table->foreign('supervisorID')
                ->references('employeeID')
                ->on('employees')
                ->nullOnDelete();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
