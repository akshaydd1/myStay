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
        'bed_number',
        'deposit_amount',
        'rent_amount',
    ];
}
