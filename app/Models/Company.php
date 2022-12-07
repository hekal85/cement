<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 *
 */
class Company extends Model
{
    use HasFactory;
    protected $guarded = [];
    //protected $fillable = [ 'name', 'detail' ];

    // One-to-One relationship between Company and Transportation
    public function Transportation(){
        return $this->hasOne(Transportation::class, 'id', 'id');
    }

    // One-to-One relationship between Company and Factory

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function Manufactory(): HasOne
    {
        return $this->hasOne(Manufactory::class,  'id', 'id');
    }

    // Many-to-One relationship between Company and City
    /**
     * @return BelongsTo
     */
    public function City():BelongsTo  {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    // One-To-Man relationship between Company and Bank
    /**
     * @return HasMany
     */
    public function Bank():HasMany  {
        return $this->HasMany (Bank::class, 'company_id', 'id');
    }
}
