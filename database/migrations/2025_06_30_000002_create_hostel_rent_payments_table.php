<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('hostel_rent_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->date('payment_month'); // format: YYYY-MM-01
            $table->decimal('rent_amount', 10, 2);
            $table->boolean('is_paid')->default(false);
            $table->date('payment_date')->nullable();
            $table->timestamps();
            $table->foreign('student_id')->references('student_id')->on('student_registrations')->onDelete('cascade');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('hostel_rent_payments');
    }
};
