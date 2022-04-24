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
        'user_id',
        'total_raised',
        'refunded',
    ];

    protected $casts = [
        'refunded' => 'boolean',
        'refunded_at' => 'datetime',
    ];

    /**
     * Get the user associated with the incident.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
