<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function detail()
    {
        return $this->belongsTo(StudentDetail::class, 'student_detail_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
