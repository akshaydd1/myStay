<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('hostel_rent_payments', function (Blueprint $table) {
            $table->unsignedBigInteger('hostel_student_id')->after('student_id');
            $table->foreign('hostel_student_id')->references('id')->on('hostel_students')->onDelete('cascade');
        });
    }
    public function down(): void
    {
        Schema::table('hostel_rent_payments', function (Blueprint $table) {
            $table->dropForeign(['hostel_student_id']);
            $table->dropColumn('hostel_student_id');
        });
    }
};
