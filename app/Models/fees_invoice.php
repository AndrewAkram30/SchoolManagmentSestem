<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class fees_invoice extends Model
{
        use HasFactory;
      protected $table = 'fees_invoices';
    use SoftDeletes;
    protected $fillable = [
'invoice_date',
'Student_id',
'Grade_id',
'Class_id',
'Free_id',
'amount',
'description',
    ];
public function Students(){
        return $this->belongsTo(student::class, 'StudeforeignKey: nt_id');
}
public function Grades(){
        return $this->belongsTo(grade::class, 'Grade_id');
}
public function Classrooms(){
        return $this->belongsTo(classroom::class, 'Class_id');
}
public function Frees(){
        return $this->belongsTo(fee::class, foreignKey: 'Free_id');
}

}
