<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    use HasFactory;

    protected $table = 'libraries';
    protected $fillable = [
'title','file_name',
'Teatcher_id','Grade_id',
'Class_id','Section_id',
    ];
    public function Teatchers(){
        return $this->belongsTo(Teatcher::class, 'Teatcher_id');
    }
    public function Grades(){
        return $this->belongsTo(grade::class, 'Grade_id');
    }
    public function Classrooms(){
        return $this->belongsTo(classroom::class, 'Class_id');
    }
    public function Sections(){
        return $this->belongsTo(section::class, 'Section_id');
    }
}
