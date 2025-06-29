<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHostelStudentsTable extends Migration {
    public function up(): void
    {
        Schema::create('hostel_students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->string('room_number', 10)->nullable();
            $table->date('admission_in_date');
            $table->date('admission_out_date')->nullable();
            $table->string('bed_number', 10)->nullable();
            $table->decimal('deposit_amount', 10, 2)->nullable();
            $table->decimal('rent_amount', 10, 2)->nullable();
            $table->timestamps();
            $table->foreign('student_id')->references('student_id')->on('student_registrations');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('hostel_students');
    }
};
