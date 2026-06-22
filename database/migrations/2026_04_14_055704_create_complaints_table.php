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
        Schema::create('complaints', function (Blueprint $table) {
    $table->id('complaintID');

    $table->string('complaintTitle');
    $table->text('complaintDescription');
    $table->string('complaintCategory');
    $table->string('complaintStatus');
    $table->date('complaintDate');
    $table->string('complaintEvidence')->nullable();

    $table->unsignedBigInteger('employeeID');

    $table->foreign('employeeID')->references('employeeID')->on('employees');

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
