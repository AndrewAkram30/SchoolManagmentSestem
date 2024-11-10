<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class student_account extends Model
{
     use HasFactory;
    use SoftDeletes;
    protected $table = 'student_accounts';
    protected $fillable = [
'Student_id',
'Grade_id',
'Class_id',
'Debit',
'Credit',
'description',
    ];
    public function Students(){
        return $this->belongsTo(student::class, 'Student_id');
}
public function Grades(){
        return $this->belongsTo(grade::class, 'Grade_id');
}
public function Classrooms(){
        return $this->belongsTo(classroom::class, 'Class_id');
}

}
