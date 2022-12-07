<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bond extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Many-to-One relationship between Bond and Person
    public function Person(): BelongsTo
    {
        return $this->belongsTo(Person::class, 'person_id', 'id');
    }


}
