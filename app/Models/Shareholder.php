<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shareholder extends Model
{
    use HasFactory;
    protected $fillable = [ 'id' ];

    // One to One relationship between Shareholder and Person
    public function Person() {
        return $this->belongsTo(Person::class, 'id', 'id');
    }
}
