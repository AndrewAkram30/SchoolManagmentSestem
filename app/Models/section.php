<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class section extends Model
{
    use HasFactory;
     protected $table = 'sections';
       public $timestamps = true;
    protected $fillable = [
        'Name_Section',
        'Status',
        'Class_id',
        'Grade_id',
    ];
      // علاقة بين الاقسام والصفوف لجلب اسم الصف في جدول الاقسام
     public function Classrooms()
    {
        return $this->belongsTo(classroom::class, 'Class_id');
    }
    public function Teatchers(){
        return $this->belongsToMany(Teatcher::class, 'teatchers_sections');
    }

}
