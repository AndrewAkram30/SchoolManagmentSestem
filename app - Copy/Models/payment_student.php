<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class payment_student extends Model
{
    protected $table = 'payment_students';
    use SoftDeletes;
    protected $fillable = [
        'date','Student_id','amount','description',

    ];
    use HasFactory;
}
