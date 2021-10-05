<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Doctor as Authenticatable;

class Doctors extends Authenticatable
{
    use HasFactory;
    protected $table = 'doctors';
    protected $fillable = ['firstname','lastname','email','password','birth_date','phone','degree','speciality_id','address','doctor_image','status'];
}
