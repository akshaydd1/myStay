<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentRegistration extends Model
{
    protected $table = 'student_registrations';
    protected $primaryKey = 'student_id';
    public $timestamps = false;
    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'date_of_birth',
        'email',
        'phone_number',
        'address',
        'city',
        'state',
        'pincode',
        'room_number',
        'gov_doc',
        'password',
    ];
}
