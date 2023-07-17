<?php

namespace Tests\Feature\Courier;

use App\Models\Courier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowDataCourierTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    public function test_success_show_data_courier(): void
    {
        // Create a dummy courier in the database
        $courier = Courier::factory()->create();

        // Send a GET request to the API endpoint
        $response = $this->get('/api/V1/courier/' . $courier->id);

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
    public function test_not_found_show_data_courier(): void
    {
        // Non-existing courier ID
        $nonExistingCourierId = 999;

        // Send a GET request to the API endpoint with the non-existing ID
        $response = $this->get('/api/V1/courier/' . $nonExistingCourierId);

        // Assert that the response has a not found status code
        $response->assertStatus(404);

        // Assert the structure of the error response JSON
        $response->assertJson([
            'success' => false,
            'code' => 404,
            'message' => 'Data Not Found',
        ]);
    }
}
