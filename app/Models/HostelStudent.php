<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HostelStudent extends Model
{
    protected $table = 'hostel_students';
    protected $fillable = [
        'student_id',
        'room_number',
        'admission_in_date',
        'admission_out_date',
        'bed_number',
        'deposit_amount',
        'rent_amount',
    ];

    public function student()
    {
        return $this->belongsTo(StudentRegistration::class, 'student_id', 'student_id');
    }

    public function rentPayments()
    {
        return $this->hasMany(\App\Models\HostelRentPayment::class, 'hostel_student_id');
    }
}
