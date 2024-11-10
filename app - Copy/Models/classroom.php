<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class classroom extends Model
{
    use HasFactory;
    protected $table = 'classrooms';
    public $timestamps = true;
    protected $fillable = [
        'Name_Class',
        'Grade_id',
    ];

      public function Grades(){
        return $this->belongsTo(grade::class,'Grade_id');
    }

}
