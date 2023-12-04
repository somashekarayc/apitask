<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasRelationships;

class Person extends Model
{
    use HasFactory;
    use HasRelationships;

    protected $table = 'persons';
    protected $fillable = ['name', 'bus_number'];

    protected $casts = [
        'bus_number' => 'integer',
    ];

    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    public function scans()
{
    return $this->hasMany(Scan::class);
}
}
