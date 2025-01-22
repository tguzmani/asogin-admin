<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberMembership extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'member_membership';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'membership_id',
        'member_id',
        'start_date',
        'end_date',
        'price',
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'price' => 'decimal:2',
    ];

    /**
     * Get the membership associated with this record.
     */
    public function membership()
    {
        return $this->belongsTo(Membership::class);
    }

    /**
     * Get the member associated with this record.
     */
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
