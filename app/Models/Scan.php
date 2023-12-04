<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasRelationships;

class Scan extends Model
{
    use HasFactory;
    use HasRelationships;

    protected $fillable = ['person_id', 'scanned_at'];

    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    public function person()
{
    return $this->belongsTo(Person::class);
}
}
