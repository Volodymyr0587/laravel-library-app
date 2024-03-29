<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'year',
        'copies_in_circulation',
    ];

    public function canBeBorrowed(): bool
    {
        return $this->activeLoans() < $this->copies_in_circulation;
    }

    private function activeLoans(): int
    {
        return $this->loans()
            ->where('is_returned', false)
            ->get()
            ->sum('number_borrowed');
    }

    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class);
    }

    public function availableCopies(): int
    {
        return $this->copies_in_circulation - $this->activeLoans();
    }

    public function canBeDeleted(): bool
    {
        // Check if there are any borrowed books releted to this book
        if ($this->loans()->count() > 0) {
            return false;
        }

        return true; // Can be deleted
    }
}
