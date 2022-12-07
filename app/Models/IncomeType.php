<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class IncomeType extends Model
{
    use HasFactory;

    // One-to-Many relationship between ExpenseType and Income
    /**
     * @return HasMany
     */
    public function IncomeType(): HasMany
    {
        return $this->hasMany(Income::class, 'income_type_id', 'id');
    }
}
