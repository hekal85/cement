<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Income extends Model
{
    use HasFactory;

    // Many-to-One relationship between Income and IncomeType
    /**
     * @return BelongsTo
     */
    public function IncomeType(): BelongsTo
    {
        return $this->belongsTo(IncomeType::class, 'income_type_id', 'id');
    }
}
