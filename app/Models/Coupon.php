<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Coupon extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'coupon',
        'value',
        'packed',
        'manufactory_id',
        'transportation_id',
    ];
/*$table->foreignId('shipping_id')->comment('شركة الشحن');
$table->foreignId('shipment_id')->nullable()->comment('الشحنة');*/
    // One to One relationship between Coupon and Manufactory

    public function Manufactory() :belongsTo {
        return $this->belongsTo(Manufactory::class, 'manufactory_id', 'id');
    }

    // One to One relationship between Coupon and Transportation
    public function Transportation() :belongsTo  {
        return $this->belongsTo(Transportation::class, 'transportation_id', 'id');
    }

    // One to One relationship between Coupon and Shipment
    public function Shipment() :belongsTo  {
        return $this->belongsTo(Shipment::class, 'shipment_id', 'id');
    }

    // Many-to-One relationship between Coupon and CementType
    public function CementType():belongsTo  {
        return $this->belongsTo(CementType::class, 'cement_type_id', 'id');
    }
}
