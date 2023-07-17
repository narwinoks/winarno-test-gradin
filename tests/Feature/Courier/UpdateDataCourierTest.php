<?php

namespace Tests\Feature\Courier;

use App\Models\Courier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateDataCourierTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_success_update_data(): void
    {
        // Create a dummy courier in the database
        $courier = Courier::factory()->create();

        // New data for the update
        $newData = [
            'name' => 'John Doe',
            'telp' => '081234567890',
            'city' => 'Jakarta',
            'level' => 3,
        ];

        // Send a PUT request to the API endpoint with the new data
        $response = $this->put('/api/V1/courier/' . $courier->id, $newData);
        // Assert that the response has a successful status code
        $response->assertStatus(200);

        // Assert the structure of the response JSON
        $response->assertJsonStructure([
            'success',
            'code',
            'message',
            'data' => [
                'id',
                'name',
                'noTelp',
                'city',
                'level',
                'created_at' => [
                    'datetime',
                    'human_diff',
                    'human',
                ],
            ],
        ]);


    }
    public function test_update_nonExistingCourier()
    {
        // Non-existing courier ID
        $nonExistingCourierId = 999;

        // New data for the update
        $newData = [
            'name' => 'win',
            'telp' => '081477084167',
            'city' => 'solo',
            'level' => 2,
        ];

        // Send a PUT request to the API endpoint with the new data
        $response = $this->put('/api/V1/courier/' . $nonExistingCourierId, $newData);

        // Assert that the response has a not found status code
        $response->assertStatus(404);

        // Assert the structure of the error response JSON
        $response->assertJson([
            'success' => false,
            'code' => 404,
            'message' => 'Data Not Found',
        ]);
    }
    public function test_update_courier_with_invalid_data()
    {
        $newData = [
            'name' => 'John Doe',
            'telp' => '081234567890',
            // 'city' field is missing
            'level' => 3,
        ];
        // Create a dummy courier in the database
        $courier = Courier::factory()->create();

        // Send a PUT request to the API endpoint with the new data
        $response = $this->put('/api/V1/courier/' . $courier->id, $newData);

        // Assert that the response has a bad request status code
        $response->assertStatus(400);

        // Assert the structure of the error response JSON
        $response->assertJsonStructure([
            'success',
            'code',
            'message',
            'errors' => [
                'city',
            ],
        ]);
    }
}
