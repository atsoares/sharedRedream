<?php

namespace Tests\Feature\Jobs;

use App\Jobs\ProcessIncidents;
use App\Models\Incident;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IncidentCreateGetTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * Process goal achieved incident
     *
     * @return void
     */
    public function test_goal_achieved_incident()
    {
        $user = User::factory()->hasWallet()->create();

        Incident::factory()->for($user)->create([
            'total_raised' => 55,
            'goal' => 50
        ]);
        
        ProcessIncidents::dispatch();

        $this->assertDatabaseMissing('incidents',[
            'active' => 1
        ]);
    }
}