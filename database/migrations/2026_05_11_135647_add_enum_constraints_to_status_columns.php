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
        // Modify complaints table - complaintStatus enum
        Schema::table('complaints', function (Blueprint $table) {
            $table->string('complaintStatus')->change();
        });

        // Modify complaint_action table - actionStatus enum
        Schema::table('complaint_action', function (Blueprint $table) {
            $table->string('actionStatus')->change();
        });

        // Modify action_approval table - decision enum
        Schema::table('action_approval', function (Blueprint $table) {
            $table->string('decision')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert changes if needed
        Schema::table('complaints', function (Blueprint $table) {
            $table->string('complaintStatus')->change();
        });

        Schema::table('complaint_action', function (Blueprint $table) {
            $table->string('actionStatus')->change();
        });

        Schema::table('action_approval', function (Blueprint $table) {
            $table->string('decision')->change();
        });
    }
};
