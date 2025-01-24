<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Membership extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'base_price',
    ];

    protected $casts = [
        'base_price' => 'decimal:2',
    ];

    /**
     * Relationship with Member model.
     */
    public function members(): BelongsToMany
    {
        return $this->belongsToMany(Member::class)->withPivot('start_date', 'end_date', 'price');
    }
}
