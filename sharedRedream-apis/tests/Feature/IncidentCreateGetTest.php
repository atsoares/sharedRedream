<?php

namespace Tests\Feature;

use App\Models\Incident;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class IncidentCreateGetTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * Authenticated Perform POST /incident passing a valid request, should pass.
     *
     * @return void
     */
    public function test_create_incident_authenticated_with_valid_request_should_pass()
    {
        //Prepare
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        
        $incident = Incident::factory()->for($user)->make();
        $data = [
            'title' => $incident->title,
            'description' => $incident->description,
            'user_id' => $incident->user_id,
        ];

        //Act
        $response = $this->postJson('/incident', $data);
        
        //Assert
        $response->assertCreated()->assertJsonFragment([
            'title' => $incident->title,
            'description' => $incident->description,
            'owner' => $user->name,
            'total_raised' => 0
        ]);
    }

    /**
     * Authenticated Perform POST /incident missing description should fail.
     *
     * @return void
     */
    public function test_create_incident_authenticated_with_invalid_request_should_fail()
    {
        //Prepare
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        
        $incident = Incident::factory()->for($user)->make();
        $data = [
            'title' => $incident->title,
            'description' => '',
            'user_id' => $incident->user_id,
        ];

        //Act
        $response = $this->postJson('/incident', $data);
        
        //Assert
        $response->assertUnprocessable();
    }

    /**
     * Unauthenticated Perform POST /incident passing a valid request, should fail.
     *
     * @return void
     */
    public function test_create_incident_unauthenticated_should_fail()
    {
        //Prepare
        $user = User::factory()->create();
        
        $incident = Incident::factory()->for($user)->make();
        $data = [
            'title' => $incident->title,
            'description' => $incident->description,
            'user_id' => $incident->user_id,
        ];

        //Act
        $response = $this->postJson('/incident', $data);
        
        //Assert
        $response->assertUnauthorized()->assertJsonFragment([
            'message' => 'Unauthenticated.'
        ]);
    }

    /**
     * Authenticated Perform GET /incidents should pass.
     *
     * @return void
     */
    public function test_get_incidents_authenticated_should_pass()
    {
        //Prepare
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $incident = Incident::factory()->for($user)->create();

        //Act
        $response = $this->get('/incidents');
        
        //Assert
        $response->assertStatus(200)->assertJsonFragment([
            'id' => $incident->id,
            'title' => $incident->title,
            'description' => $incident->description,
            'owner' => $incident->user->name
        ]);
    }

    /**
     * Unauthenticated Perform GET /incidents should fail.
     *
     * @return void
     */
    public function test_get_incidents_unauthenticated_should_fail()
    {
        //Prepare
        //Act
        $this->get('/incidents');

        //Assert
        $this->assertGuest();
    }
}
