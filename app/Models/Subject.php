<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $table = 'subjects';
    protected $fillable=[
        'name_subject','Grade_id','Class_id','Teatcher_id'
    ];

 public function Grades(){
        return $this->belongsTo(grade::class, 'Grade_id');
 }
 public function Classrooms(){
        return $this->belongsTo(classroom::class, 'Class_id');
 }
 public function Teatchers(){
        return $this->belongsTo(Teatcher::class, 'Teatcher_id');
 }
}
