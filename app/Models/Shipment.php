<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Shipment extends Model
{
    use HasFactory;
    protected $guarded = [];
    /*protected $fillable = [
        'manufactory_id',
        'transportation_id',
        'payload',
        'cost',
        'trans',
        'total',
        'remaining',
        'done',
        'notes',
    ];*/

    // One to Many relationship between Shipment and Coupon
    /**
     * @return HasMany
     */
    public function Coupon():HasMany {
        return $this->hasMany(Coupon::class, 'shipment_id', 'id');
    }

    // Many-to-One relationship between Shipment and Person
    public function Driver(): belongsTo {
        return $this->belongsTo(Person::class, 'driver', 'id');
    }

    // Many-to-One relationship between Shipment and Manufactory
    public function Manufactory(): belongsTo {
        return $this->belongsTo(Manufactory::class, 'manufactory_id', 'id');
    }

    // // One to One  relationship between Shipment and Transportation
    public function Transportation(): belongsTo {
        return $this->belongsTo(Transportation::class, 'transportation_id', 'id');
    }
    // One-to-Many relationship between Shipment and ShipmentDetails
    public function ShipmentDetails(): HasMany {
        return $this->hasMany(ShipmentDetails::class, 'shipment_id', 'id');
    }
}
