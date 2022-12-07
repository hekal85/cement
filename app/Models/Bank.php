<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bank extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Many-to-One relationship between Bank and Company
    /**
     * @return BelongsTo
     */
    public function Company():BelongsTo  {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
}
