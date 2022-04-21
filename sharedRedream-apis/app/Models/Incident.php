<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'goal_value',
        'user_id',
        'active',
        'refunded',
    ];

    protected $casts = [
        'active' => 'boolean',
        'refunded' => 'boolean',
        'refunded_at' => 'datetime',
    ];

}
