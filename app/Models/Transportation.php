<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transportation extends Model
{
    use HasFactory;
    protected $fillable = ['id'];

    // One to One relationship between Transportation and Company
    public function Company(): belongsTo {
        return $this->belongsTo(Company::class, 'id', 'id');
    }

    // One to Many relationship between Transportation and Coupon
    public function Coupon(): hasMany {
        return $this->hasMany(Coupon::class, 'transportation_id', 'id');
    }

    // One to Many relationship between Transportation and Driver
    public function Driver(): hasMany {
        return $this->hasMany(Driver::class, 'transportation_id', 'id');
    }

    // One to One relationship between Transportation and Shipment
    public function Shipment(): hasOne{
        return $this->hasOne(Shipment::class,  'transportation_id', 'id');
    }
}
