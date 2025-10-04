<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blood_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donor_id')->constrained()->onDelete('cascade');
            $table->string('patient_name');
            $table->string('disease');
            $table->enum('blood_type', ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-']);
            $table->integer('blood_quantity'); // in bags
            $table->boolean('is_emergency')->default(false);
            $table->dateTime('needed_date')->nullable();
            $table->string('hospital_name');
            $table->string('hospital_location');
            $table->string('division');
            $table->string('district');
            $table->string('upazila');
            $table->string('contact_number');
            $table->text('additional_notes')->nullable();
            $table->enum('status', ['active', 'fulfilled', 'cancelled'])->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blood_requests');
    }
};