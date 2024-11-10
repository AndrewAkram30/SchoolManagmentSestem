<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class student extends Model
{
    use SoftDeletes;
    protected $table = 'students';
    public $timestamps = true;
    protected $fillable = [
        'Name',
        'Email',
        'Password',
        'Gender_id',
        'Nationalite_id',
        'Type_Blood',
        'Parent_id',
        'Grade_id',
        'Classroom_id',
        'section_id',
        'Date_Birth',
        'Acadmic_Year',
    ];
    public function Genders(){
        return $this->belongsTo(Gender::class, 'Gender_id');
    }
    public function Grades(){
        return $this->belongsTo(grade::class, 'Grade_id');
    }
    public function Classrooms(){
        return $this->belongsTo(classroom::class, foreignKey: 'Classroom_id');
    }
    public function Sections(){
        return $this->belongsTo(section::class, foreignKey: 'Section_id');
    }
public function images(){
        return $this->morphMany(image::class,'imagable' );
}

}
