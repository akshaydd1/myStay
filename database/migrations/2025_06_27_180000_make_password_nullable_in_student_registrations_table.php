<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakePasswordNullableInStudentRegistrationsTable extends Migration {
    public function up(): void
    {
        Schema::table('student_registrations', function (Blueprint $table) {
            $table->string('password', 255)->nullable()->change();
        });
    }
    public function down(): void
    {
        Schema::table('student_registrations', function (Blueprint $table) {
            $table->string('password', 255)->nullable(false)->change();
        });
    }
};
