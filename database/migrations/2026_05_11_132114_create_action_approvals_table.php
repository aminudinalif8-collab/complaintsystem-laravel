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
        Schema::create('action_approval', function (Blueprint $table) {

            $table->id('approvalID');

            $table->string('decision');
            $table->text('managerRemarks')->nullable();

            $table->unsignedBigInteger('actionID');
            $table->unsignedBigInteger('managerID');

            $table->timestamps();

            // FK action
            $table->foreign('actionID')
                ->references('actionID')
                ->on('complaint_action')
                ->onDelete('cascade');

            // FK manager
            $table->foreign('managerID')
                ->references('employeeID')
                ->on('employees')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('action_approval');
    }
};
