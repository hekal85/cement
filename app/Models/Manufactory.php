<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufactory extends Model
{
    use HasFactory;
    protected $guarded = [];

    // One to One relationship between Manufactory and Company
    public function Company() {
        return $this->belongsTo(Company::class, 'id', 'id');
    }

    // One to One relationship between Manufactory and Coupon
    public function Coupon() {
        return $this->hasMany(Coupon::class, 'manufactory_id', 'id');
    }

    // One to One relationship between Manufactory and Shipment
    public function Shipment(){
        return $this->hasOne(Shipment::class,  'shipment_id', 'id');
    }
}
