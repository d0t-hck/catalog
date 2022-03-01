<?php

namespace Tests\Feature;

use App\Models\Creator;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use TestCase;

class CreatorTest extends TestCase
{
    // use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetCreators()
    {
        $this->get('/api/creator');
        $this->response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'info',
                        'type',
                        'created_at',
                        'updated_at'
                    ]
                ]
            ]);
    }

    public function testGetAuthors() {
        $this->get('/api/creator?type=author');
        // dd($this->response);
        $this->response->assertStatus(200)
            ->assertJson([
                'data' => [
                    ['type' => "Author"]
                ]
            ]);
    }

    public function testGetArtists() {
        $this->get('/api/creator?type=artist');
        $this->response
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    ['type' => "Artist"]
                ]
            ]);
    }

    public function testGetPublishers() {
        $this->get('/api/creator?type=publisher');
        $this->response
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    ['type' => "Publisher"]
                ]
            ]);
    }
    
    public function testUpdateCreator() {
        $name = 'Test Name';
        $info = 'info about creator';
        $type = 'Artist';
        $id = Creator::factory()->create()->id;
        $this->put('/api/creator/'.$id, ['name' => 'Test Name', 'info' => 'info about creator', 'type'=>'Artist']);
        $this->response
            ->assertStatus(200)
            ->assertJson([
                'id' => $id,
                'name' => $name,
                'info' => $info,
                'type' => $type,
            ]);
    }

    public function testDeleteCreator() {
        $id = Creator::all()->random()->id;
        $this->delete('/api/creator/'.$id);
        $this->response->assertStatus(204);
        // $this->notSeeInDatabse('creators', ['id' => $id]);
    }

    public function testValidatorFails() {
        $creator = Creator::factory()->create();
        $this->post('/api/creator', ['name' => $creator->name, 'type' => 'wrongType']);
        $this->response
            ->assertStatus(422)
            ->assertJsonStructure([
                #TODO: write json structure
            ]);
    }

    public function testNotFound() {
        $id = 964;
        // assertDatabseMissing('creators', ['id' => $id]);
        $this->get('/api/creator/'.$id);
        $this->response
            ->assertStatus(404);
    }
}
