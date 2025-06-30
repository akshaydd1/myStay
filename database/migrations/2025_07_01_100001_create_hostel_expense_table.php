<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('hostel_expense', function (Blueprint $table) {
            $table->id('expense_id');
            $table->date('expense_date');
            $table->decimal('amount', 10, 2);
            $table->unsignedBigInteger('category_id');
            $table->string('receipt', 255)->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('expense_categories')->onDelete('cascade');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('hostel_expense');
    }
};
