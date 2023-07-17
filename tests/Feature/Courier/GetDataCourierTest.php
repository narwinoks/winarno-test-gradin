<?php

namespace Tests\Feature\Courier;

use App\Models\Courier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetDataCourierTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function testGetCouriersSucces()
    {
        // Create dummy data in the database
        Courier::factory()->count(5)->create();

        // Send a GET request to the API endpoint
        $response = $this->get('/api/V1/courier');

        // Assert that the response has a successful status code
        $response->assertStatus(200);

        // Assert that the response contains the correct number of couriers
        $response->assertJsonCount(4, 'data');

        // Assert that the response has the expected structure and fields
        $response->assertJsonStructure([
            'success',
            'message',
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'noTelp',
                    'city',
                    'level',
                    'created_at' => [
                        'datetime',
                        'human_diff',
                        'human'
                    ]
                ]
            ],
            'meta'
        ]);
    }
    public function testGetCouriersFilterName(){
        // Create dummy data in the database
        Courier::factory()->count(5)->create();

        // Send a GET request to the API endpoint
        $response = $this->get('/api/V1/courier?name=Budiono');

        // Assert that the response has a successful status code
        $response->assertStatus(200);

        // Assert that the response contains the correct number of couriers
        $response->assertJsonCount(4, 'data');

        // Assert that the response has the expected structure and fields
        $response->assertJsonStructure([
            'success',
            'message',
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'noTelp',
                    'city',
                    'level',
                    'created_at' => [
                        'datetime',
                        'human_diff',
                        'human'
                    ]
                ]
            ],
            'meta'
        ]);
    }
}
