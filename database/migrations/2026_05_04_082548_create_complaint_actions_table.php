<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('complaint_action', function (Blueprint $table) {

            $table->id('actionID');

            $table->text('actionDescription')->nullable();
            $table->string('actionStatus')->default('Pending');
            $table->dateTime('actionDate')->nullable();

            $table->unsignedBigInteger('complaintID');
            $table->unsignedBigInteger('supervisorID');

            $table->timestamps();

            // FK complaint
            $table->foreign('complaintID')
                ->references('complaintID')
                ->on('complaints')
                ->onDelete('cascade');

            // FK supervisor (ACTOR)
            $table->foreign('supervisorID')
                ->references('employeeID')
                ->on('employees')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('complaint_action');
    }
};