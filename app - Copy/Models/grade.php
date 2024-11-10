<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class grade extends Model
{

       protected $table = 'grades';
       public $timestamps = true;
       protected $fillable = [
        'Names',
        'Notes',
       ];
       public function Sections()  {
        return $this->hasMany(section::class, 'Section_id');
      }
      public function Classrooms(){
        return $this->hasMany(classroom::class, 'Class_id');
      }


}
