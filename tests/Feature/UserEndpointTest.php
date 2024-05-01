<?php

namespace Tests\Feature;

use Modules\Transactions\Services\UserService;
use Tests\TestCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class UserEndpointTest extends TestCase
{
    /**
     * Test retrieval of filtered user data from JSON files.
     *
     * @return void
     */
    public function testUserEndpointDataRetrieval()
    {
        // Arrange: Mock the external JSON file access
        Storage::fake('local');
        $dummyData = json_encode([
            [
                'provider' => 'DataProviderX',
                'amount' => 100,
                'currency' => 'USD',
                'email' => 'parent1@parent.eu',
                'status' => 'authorised',
                'registrationDate' => '2018-11-30',
                'identification' => 'd3d29d70-1d25-11e3-8591-034165a3a613'
            ],
            // Add more items if necessary
        ]);
        Storage::disk('local')->put('files/DataProviderX.json', $dummyData);

        // Mock the service method to return this data
        $mockedService = $this->mock(UserService::class, function ($mock) use ($dummyData) {
            $mock->shouldReceive('getFilteredData')
                ->andReturn(json_decode($dummyData, true));
        });

        // Act: Make a GET request to the endpoint
        $response = $this->get('api/v1/users');

        // Assert: Check if the response has the correct data and structure
        $response->assertStatus(JsonResponse::HTTP_OK)
            ->assertJson([
                'status' => 'success',
                'data' => json_decode($dummyData, true)
            ]);
    }
}

