<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RedeemVoucher extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'token',
        'value',
        'user_id',
        'refunded',
    ];

    protected $casts = [
        'active' => 'boolean',
        'refunded' => 'boolean',
        'refunded_at' => 'datetime',
    ];
}
