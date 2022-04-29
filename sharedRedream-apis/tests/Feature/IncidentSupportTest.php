<?php

namespace Tests\Feature;

use App\Models\Incident;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class IncidentSupportTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * Authenticated Perform POST /incident/{id}/support passing a valid request, should pass.
     *
     * @return void
     */
    public function test_support_incident_authenticated_with_valid_request_should_pass()
    {
        //Prepare
        $user = User::factory()->hasWallet()->create();
        Sanctum::actingAs($user);
        
        $value = round($user->wallet->balance-random_int(20, 40), 2);
        $data = [
            'user_id' => $user->id,
            'value' => $value,
        ];

        $incident = Incident::factory()->create();
        
        //Act
        $id = '/'.$incident->id;
        $uri = '/incident'.$id.'/support';
        $response = $this->postJson($uri, $data);
        
        //Assert
        $response->assertStatus(200);
        $response->assertJsonFragment(['owner' => $incident->user->name ]);
        $response->assertJsonFragment(['total_raised' => $value ]);
        $response->assertJsonFragment(['operation' => 'incident_help']);
        $response->assertJsonFragment(['user' => $user->name ]);
    }

    /**
     * Authenticated Perform POST /incident/{id}/support with not enougth balance, should fail.
     *
     * @return void
     */
    public function test_support_incident_authenticated_with_not_enougth_balance_should_fail()
    {
        //Prepare
        $user = User::factory()->hasWallet()->create();
        Sanctum::actingAs($user);
        
        $data = [
            'user_id' => $user->id,
            'value' => 110,
        ];

        $incident = Incident::factory()->create();
        
        //Act
        $id = '/'.$incident->id;
        $uri = '/incident'.$id.'/support';
        $response = $this->postJson($uri, $data);
        
        //Assert
        $response->assertUnprocessable();
    }

    /**
     * Authenticated Perform POST /incident/{id}/support with invalid request, should fail.
     *
     * @return void
     */
    public function test_support_incident_authenticated_with_invalid_request_should_fail()
    {
        //Prepare
        $user = User::factory()->hasWallet()->create();
        Sanctum::actingAs($user);
        
        $data = [
            'user_id' => $user->id,
            'value' => '',
        ];

        $incident = Incident::factory()->create();
        
        //Act
        $id = '/'.$incident->id;
        $uri = '/incident'.$id.'/support';
        $response = $this->postJson($uri, $data);
        
        //Assert
        $response->assertUnprocessable();
    }

    /**
     * Unauthenticated Perform POST /incident/{id}/support should fail.
     *
     * @return void
     */
    public function test_support_incident_unauthenticated_should_fail()
    {
        //Prepare
        $user = User::factory()->hasWallet()->create();
        
        $data = [
            'user_id' => $user->id,
            'value' => 10,
        ];
        $incident = Incident::factory()->create();
        
        //Act
        $id = '/'.$incident->id;
        $uri = '/incident'.$id.'/support';
        $this->postJson($uri, $data);

        //Assert
        $this->assertGuest();
    }
}
