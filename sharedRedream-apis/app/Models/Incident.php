<?php

namespace App\Models;

use DateTimeInterface;
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
        'goal',
        'expires_at',
        'refunded',
    ];

    protected $casts = [
        'refunded' => 'boolean',
        'expires_at' => 'date:d-m-Y H:i:s',
        'refunded_at' => 'datetime:d-m-Y H:i:s',
    ];

    /**
     * Get the user associated with the incident.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the transactions associated with the incident.
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
