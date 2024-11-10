<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teatcher extends Model
{
    use HasFactory;
    public $table = 'teatchers';
    public $timestamps = true;
    protected $fillable = [
'Email','Email_Verfied_at','Password',
'Name','Gender_id','Specialization_id',
'Address','Phone_number',

    ];
    public function Genders(){
        return $this->belongsTo(Gender::class, 'Gender_id');
    }
    public function Specializations(){
        return $this->belongsTo(Specialization::class, 'Specialization_id');
    }
    public function Sections(){
        return $this->belongsToMany(section::class, 'teatchers_sections');
    }
     // has many" (علاقة واحد إلى متعدد)
     //belongs to many" (علاقة متعدد إلى متعدد)
}
