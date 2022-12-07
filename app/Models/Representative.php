<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Representative extends Model
{
    use HasFactory;

    protected $guarded = [];


    // Many-to-One relationship between Representative and Client

    /**
     * @return HasMany
     */
    // One to One relationship between Representative and Client
    public function Client() : HasMany {
        return $this->hasMany(Client::class, 'representative_id', 'id');
    }

    // One to One relationship between Representative and Person
    public function Person() : BelongsTo {
        return $this->belongsTo(Person::class, 'id', 'id');
    }

    // One to One relationship between Representative and ShipmentDetails
    public function ShipmentDetails(): HasOne
    {
        return $this->hasOne(ShipmentDetails::class, 'representative_id', 'id');
    }

    // One to One relationship between Representative and Itinerary
    public function Itinerary(): HasMany
    {
        return $this->hasMany(Itinerary::class, 'representative_id', 'id');
    }

}
