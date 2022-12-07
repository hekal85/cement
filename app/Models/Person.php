<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 *
 */
class Person extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    protected $table = 'persons';
    protected $guarded = [];
//    protected $fillable = [ 'name', 'email' , 'mobile' , 'phone' , 'ssn' , 'credit' , 'image' , 'notes' ];

    /**
     *
     */
    public function registerMediaCollection(): void
    {
        $this->addMediaCollection('image')->singleFile();
    }

    // One-to-One relationship between Person and Client
    /**
     * @return HasOne
     */
    public function Client(): HasOne {
        return $this->hasOne(Client::class, 'id', 'id');
    }

    // One-to-One relationship between Person and Driver
    /**
     * @return HasOne
     */
    public function Driver(): HasOne {
        return $this->hasOne(Driver::class, 'id', 'id');
    }

    // One-to-One relationship between Person and Representative
    /**
     * @return HasOne
     */
    public function Representative(): HasOne
    {
        return $this->hasOne(Representative::class,  'id', 'id');
    }

    // One-to-One relationship between Person and Shareholders

    /**
     * @return HasOne
     */
    public function Shareholder(): HasOne
    {
        return $this->hasOne(Shareholder::class,  'id', 'id');
    }

    // One-to-Many relationship between Person and City
    /**
     * @return BelongsTo
     */
    public function City(): BelongsTo
    {
        return $this->belongsTo(City::class,  'city_id', 'id');
    }

    // One-to-Many relationship between Person and Bond
    public function Bond(): HasMany
    {
        return $this->hasMany(Bond::class, 'person_id', 'id');
    }

    // One-to-Many relationship between Person and Shipment
    public function Shipment(): HasMany
    {
        return $this->hasMany(Shipment::class, 'driver', 'id');
    }


}
