<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scan extends Model
{
    use HasFactory;

    protected $fillable = ['person_id', 'scanned_at'];

    public function getNameAttribute($value)
    {
        return ucwords($value);
    }
}
