<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExpenseType extends Model
{
    use HasFactory;
    protected $guarded = [];

    // One-to-Many relationship between ExpenseType and Expense
    /**
     * @return HasMany
     */
    public function Expense(): HasMany
    {
        return $this->hasMany(Expense::class, 'expense_type_id', 'id');
    }
}
