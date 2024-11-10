<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student_promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'Student_id',
        'From_Grade_id',
        'From_Class_id',
        'From_Section_id',
        'To_Grade_id',
        'To_Class_id',
        'To_Section_id',

    ];
    protected $table = 'student_promotions';
    public $timestamps = true;
}
