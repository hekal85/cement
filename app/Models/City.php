<?php /** @noinspection ALL */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    use HasFactory;

    protected $guarded = [];
    // One-to-Many relationship between City and ItineraryDetails
    /**
     * @return HasMany
     */
    public function ItineraryDetails(): HasMany {
        return $this->hasMany(ItineraryDetails::class, 'city_id', 'id');
    }

    // One-to-Many relationship between City and Company
    /**
     * @return HasMany
     */
    public function Company(): HasMany {
        return $this->hasMany(Company::class, 'city_id', 'id');
    }

    // One-to-Many relationship between City and Person
    /**
     * @return HasMany
     */
    public function Person(): HasMany {
        return $this->hasMany(Person::class, 'city_id', 'id');
    }
}
