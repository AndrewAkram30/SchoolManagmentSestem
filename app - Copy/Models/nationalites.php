<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nationalites extends Model
{
    protected $fillable = ['Name'];
    use HasFactory;
}