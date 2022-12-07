<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Client extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Many-to-One relationship between Client and Representative

    /**
     * @return BelongsTo
     */
    public function Representative(): BelongsTo {
        return $this->belongsTo(Representative::class, 'representative_id', 'id');
    }

    // One to One relationship between Client and Person

    /**
     * @return BelongsTo
     */
    public function Person(): BelongsTo
    {
        return $this->belongsTo(Person::class, 'id', 'id');
    }

    // One-to-One relationship between Client and ShipmentDetails
    /**
     * @return HasOne
     */
    public function ShipmentDetails(): HasOne
    {
        return $this->hasOne(ShipmentDetails::class, 'client_id', 'id');
    }

    // Many-to-One relationship between Client and ItineraryDetails
    /**
     * @return BelongsTo
     */
    public function ItineraryDetails(): BelongsTo {
        return $this->belongsTo(ItineraryDetails::class, 'itinerary_details_id', 'id');
    }
}
