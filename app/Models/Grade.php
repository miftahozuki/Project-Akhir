<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'name',
        'major_id'
    ];

    public function student()
    {
        return $this->hasMany(StudentDetail::class);
    }

    public function major()
    {
        return $this->belongsTo(Major::class);
    }
}
