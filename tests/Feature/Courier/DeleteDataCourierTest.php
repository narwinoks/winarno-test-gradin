<?php

namespace Tests\Feature\Courier;

use App\Models\Courier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteDataCourierTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_delete_courier()
    {
        // Create a dummy courier in the database
        $courier = Courier::factory()->create();

        // Send a DELETE request to the API endpoint
        $response = $this->delete('/api/V1/courier/' . $courier->id);

        // Assert that the response has a successful status code
        $response->assertStatus(200);

        // Assert that the response contains the delete success message
        $response->assertJson([
            'success' => true,
            'code' =>200,
            'message' => 'Delete Courier Success',
        ]);

    }
    public function test_delete_courier_not_found()
    {
        // Non-existing courier ID
        $nonExistingCourierId = 999;
        // Create a dummy courier in the database
        $courier = Courier::factory()->create();

        // Send a DELETE request to the API endpoint
        $response = $this->delete('/api/V1/courier/' . $nonExistingCourierId);

        // Assert that the response has a successful status code
        $response->assertStatus(404);

        // Assert that the response contains the delete success message
        $response->assertJson([
            'success' => false,
            'code' =>404,
            'message' => 'Data Not Found',
        ]);

    }


}
