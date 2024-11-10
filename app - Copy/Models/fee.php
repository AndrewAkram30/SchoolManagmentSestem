<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class fee extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'fees';
        protected $fillable=['title','amount','Grade_id','Classroom_id','year','description','free_type'];


public function Grades(){
        return $this->belongsTo(grade::class, 'Grade_id');

}
public function Classrooms(){
     return $this->belongsTo(classroom::class, 'Class_id');
}
}
