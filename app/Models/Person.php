<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'bus_number'];

    protected $casts = [
        'bus_number' => 'integer',
    ];

    public function getNameAttribute($value)
    {
        return ucwords($value);
    }
}
