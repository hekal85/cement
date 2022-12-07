<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CementType extends Model
{
    use HasFactory;


    // One-to-Many relationship between CementType and Coupon
    public function Coupon(): HasMany {
        return $this->hasMany(Coupon::class, 'cement_type_id', 'id');
    }
}
