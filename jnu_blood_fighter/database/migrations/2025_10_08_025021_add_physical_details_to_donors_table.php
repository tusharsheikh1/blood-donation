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
        Schema::table('donors', function (Blueprint $table) {
            // Add new columns after the blood_type column for logical grouping
            $table->enum('gender', ['Male', 'Female', 'Other'])->nullable()->after('blood_type');
            $table->integer('height_cm')->nullable()->after('gender');
            $table->integer('weight_kg')->nullable()->after('height_cm');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donors', function (Blueprint $table) {
            // Drop the new columns in the reverse order of addition
            $table->dropColumn('weight_kg');
            $table->dropColumn('height_cm');
            $table->dropColumn('gender');
        });
    }
};