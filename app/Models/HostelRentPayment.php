<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HostelRentPayment extends Model
{
    protected $table = 'hostel_rent_payments';
    protected $fillable = [
        'student_id',
        'hostel_student_id',
        'payment_month',
        'rent_amount',
        'is_paid',
        'payment_date',
    ];

    public function hostelStudent()
    {
        return $this->belongsTo(HostelStudent::class, 'hostel_student_id');
    }
}
