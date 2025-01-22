<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Membership extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'membership_type', // e.g., basic, premium, annual, etc.
        'start_date',
        'end_date',
        'status', // active/inactive
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    /**
     * Relationship with Member model.
     */
    public function members(): BelongsToMany
    {
        return $this->belongsToMany(Member::class)->withPivot('start_date', 'end_date', 'price');
    }
}
