<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 *
 */
class ItineraryDetails extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Many-to-One relationship between ShipmentDetails and Itinerary
    /**
     * @return BelongsTo
     */
    public function Itinerary():BelongsTo  {
        return $this->belongsTo(Itinerary::class, 'itinerary_id', 'id');
    }

    // One-to-Many relationship between ItineraryDetails and Client
    /**
     * @return HasMany
     */
    public function Client(): HasMany {
        return $this->hasMany(Client::class, 'itinerary_details_id', 'id');
    }

    // Many-to-One relationship between ItineraryDetails and City
    /**
     * @return BelongsTo
     */
    public function City():BelongsTo  {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }


}
