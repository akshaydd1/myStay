<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HostelExpense extends Model
{
    protected $table = 'hostel_expense';
    protected $primaryKey = 'expense_id';
    protected $fillable = [
        'expense_date',
        'amount',
        'category_id',
        'receipt',
        'note',
    ];

    public function category()
    {
        return $this->belongsTo(ExpenseCategory::class, 'category_id');
    }
}
