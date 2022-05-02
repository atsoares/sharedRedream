<?php

namespace Database\Factories;

use App\Models\Incident;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'redeem_voucher_id' => null,
            'incident_id' => Incident::factory(),
            'value' => '20', 
            'operation' => 'incident_help',
        ];
    }
}
