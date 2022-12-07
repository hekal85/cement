<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Expense extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Many-to-One relationship between Expense and ExpenseType
    public function ExpenseType(): BelongsTo
    {
        return $this->belongsTo(ExpenseType::class, 'expense_type_id', 'id');
    }

    // Many-to-One relationship between Expense and Person
    public function Person(): BelongsTo
    {
        return $this->belongsTo(Person::class, 'person_id', 'id');
    }

}
