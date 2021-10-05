<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorSchedule extends Model
{
    use HasFactory;

    protected $table = 'Doctor_schedule';
    protected $fillable = ['doctor_id','schedule_date','start_time','end_time','consulting_time','status'];
}
