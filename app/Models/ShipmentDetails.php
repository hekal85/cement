<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShipmentDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'shipment_id',
        'representative_id',
        'client_id',
        'payload',
        'cost',
        'transportation',
        'paid',
        'total',
        'owed',
        'notes',
        'discount',
        'created_at',
    ];

    // Many-to-One relationship between ShipmentDetails and Shipment
    public function Shipment():belongsTo  {
        return $this->belongsTo(Shipment::class, 'shipment_id', 'id');
    }

    // One to One relationship between ShipmentDetails and Representative
    public function Representative(): belongsTo {
        return $this->belongsTo(Representative::class, 'representative_id', 'id');
    }

    // One to One relationship between ShipmentDetails and Client
    public function Client(): belongsTo {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }
}
