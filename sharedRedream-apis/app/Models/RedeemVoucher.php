<?php

namespace App\Models;

use DateTimeInterface;
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
        'active',
        'refunded_at'
    ];

    protected $casts = [
        'refunded_at' => 'datetime:d-m-Y H:i:s',
        'active' => 'boolean',
    ];

    /**
     * Get the user associated with the redeem voucher.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param  \DateTimeInterface  $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d-m-Y H:i:s');
    }
}
