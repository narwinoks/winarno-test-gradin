<?php

namespace Tests\Feature\Courier;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class StoreDataCourierTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_success_store_data(): void
    {
        $data = [
            'name' => 'John Doe',
            'telp' => '081234567890',
            'city' => 'Jakarta',
            'level' => 3,
        ];

        // Send a POST request to the API endpoint with the data
        $response = $this->post('/api/V1/courier', $data);

        // Assert that the response has a successful status code
        $response->assertStatus(201);

        // Assert that the response contains the created courier data
        $response->assertJsonStructure([
            'success',
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


        // Assert that the courier data is stored in the database
        $this->assertDatabaseHas('couriers', $data);
    }
    public function test_store_courier_with_invalid_data()
    {
        $data = [
            'name' => 'John Doe',
            'telp' => '081234567890',
            // 'city' field is missing
            'level' => 3,
        ];

        // Send a POST request to the API endpoint with the invalid data
        $response = $this->post('/api/V1/courier', $data);

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
