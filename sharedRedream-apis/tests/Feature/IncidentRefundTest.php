<?php

namespace Tests\Feature;

use App\Models\Incident;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class IncidentRefundTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * Authenticated Perform POST /incident/{id}/refund passing a valid request, should pass.
     *
     * @return void
     */
    public function test_refund_incident_authenticated_owner_should_pass()
    {
        //Prepare
        //prepare.step 1: create incident
        $user = User::factory()->hasWallet()->create();
        $incident = Incident::factory()->for($user)->create();

        //prepare.step 2: support incident
        $user2 = User::factory()->hasWallet()->create();
        Sanctum::actingAs($user2);
        
        $value = round($user2->wallet->balance-random_int(20, 40), 2);
        $data = [
            'user_id' => $user2->id,
            'value' => $value,
        ];
        $id = '/'.$incident->id;
        $uriSupport = '/incident'.$id.'/support';
        $this->postJson($uriSupport, $data);
        
        //prepare.step 3: refund incident
        Sanctum::actingAs($user);
       
        //Act  
        $uriRefund = '/incident'.$id.'/refund';
        $response = $this->postJson($uriRefund);
        
        //Assert
        $response->assertStatus(200);
        $response->assertJsonFragment(['refunded' => true]);
        $response->assertJsonFragment(['owner' => $incident->user->name ]);
        $response->assertJsonFragment(['operation' => 'incident_refund']);
        $response->assertJsonFragment(['user' => $incident->user->name ]);
    }

     /**
     * Authenticated Perform POST /incident/{id}/refund passing a valid request, should pass.
     *
     * @return void
     */
    public function test_refund_incident_authenticated_not_owner_should_fail()
    {
        //Prepare
        //prepare.step 1: create incident
        $user = User::factory()->hasWallet()->create();
        $incident = Incident::factory()->for($user)->create();

        //prepare.step 2: support incident
        $user2 = User::factory()->hasWallet()->create();
        Sanctum::actingAs($user2);
        
        $value = round($user2->wallet->balance-random_int(20, 40), 2);
        $data = [
            'user_id' => $user2->id,
            'value' => $value,
        ];
        $id = '/'.$incident->id;
        $uriSupport = '/incident'.$id.'/support';
        $this->postJson($uriSupport, $data);
        
        //prepare.step 3: refund incident
        Sanctum::actingAs($user2);
       
        //Act  
        $uriRefund = '/incident'.$id.'/refund';
        $response = $this->postJson($uriRefund);
        
        //Assert
        $response->assertStatus(200);
        $response->assertJsonFragment(['refunded' => true]);
        $response->assertJsonFragment(['owner' => $incident->user->name ]);
        $response->assertJsonFragment(['operation' => 'incident_refund']);
        $response->assertJsonFragment(['user' => $incident->user->name ]);
    }
}
