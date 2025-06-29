<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPasswordToStudentRegistrationsTable extends Migration {
    public function up(): void
    {
        Schema::table('student_registrations', function (Blueprint $table) {
            $table->string('password', 255)->after('email');
        });
    }
    public function down(): void
    {
        Schema::table('student_registrations', function (Blueprint $table) {
            $table->dropColumn('password');
        });
    }
};
