<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['price', 'years'];

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }
}
