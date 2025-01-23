<?php

// app/Models/Appointment.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    // Specify the table name if it's not the plural of the model name
    protected $table = 'appointments';

    // Specify the fillable fields (mass assignment protection)
    protected $fillable = [
        'client_name',
        'email',
        'dob',
        'appointment_date',
        'appointment_time',
        'notes'
    ];

    // If you want to handle date fields (optional)
    protected $dates = [
        'appointment_date',
        'created_at',
        'updated_at'
    ];
}
