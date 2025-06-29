<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsAdminToStudentRegistrationsTable extends Migration {
    public function up(): void
    {
        Schema::table('student_registrations', function (Blueprint $table) {
            $table->boolean('is_admin')->default(false)->after('password');
        });
    }
    public function down(): void
    {
        Schema::table('student_registrations', function (Blueprint $table) {
            $table->dropColumn('is_admin');
        });
    }
};
