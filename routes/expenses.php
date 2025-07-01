<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\HostelExpense;
use App\Models\ExpenseCategory;

Route::post('/expenses', function (Request $request) {
    $request->validate([
        'expense_date' => 'required|date',
        'amount' => 'required|numeric|min:0.01',
        'category_id' => 'required|exists:expense_categories,id',
        'receipt' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'note' => 'nullable|string',
    ]);
    $receiptPath = null;
    if ($request->hasFile('receipt')) {
        $receiptPath = $request->file('receipt')->store('receipts', 'public');
    }
    HostelExpense::create([
        'expense_date' => $request->expense_date,
        'amount' => $request->amount,
        'category_id' => $request->category_id,
        'receipt' => $receiptPath,
        'note' => $request->note,
    ]);
    return Redirect::back()->with('status', 'Expense added successfully!');
})->name('expenses.store');

// Add route for storing expense categories
Route::post('/expense-categories', function (Request $request) {
    $request->validate([
        'category_name' => 'required|string|max:100|unique:expense_categories,category_name',
    ]);
    ExpenseCategory::create([
        'category_name' => $request->category_name,
    ]);
    return Redirect::back()->with('status', 'Category added successfully!');
})->name('expense-categories.store');
