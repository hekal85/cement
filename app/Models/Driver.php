<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Driver extends Model
{
    use HasFactory;

    protected $guarded = [];

    // One to One relationship between Driver and Person
    public function Person(): belongsTo {
        return $this->belongsTo(Person::class, 'id', 'id');
    }


    // One to Many relationship between Driver and Transportation
    public function Transportation(): belongsTo {
        return $this->belongsTo(Transportation::class, 'transportation_id', 'id');

    }

}
