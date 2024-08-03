<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Classes;

class Section extends Model
{
    use HasFactory;

    protected $fillabel = [
        'name',
        'class_id'
    ];

    public function student()
    {
        return $this->hasMany(Student::class);
    }

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }
}
