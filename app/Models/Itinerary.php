<?php /** @noinspection ALL */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Itinerary extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'representative_id', 'day1', 'day2'];


    // One-to-Many relationship between Itinerary and ItineraryDetails
    public function ItineraryDetails(): HasMany {
        return $this->hasMany(ItineraryDetails::class, 'itinerary_id', 'id');
    }

    // Many-to-One Relationship Representative between and Itinerary
    /**
     * @return BelongsToMany
     */
    public function Representative(): belongsTo
    {
        return $this->belongsTo(Representative::class, 'representative_id', 'id');
    }
}
