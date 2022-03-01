<?php

namespace Tests\Feature;

use App\Models\Genre;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use TestCase;

class GenreTest extends TestCase
{
    // use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetCreators()
    {
        $this->get('/api/genre');
        $this->response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'created_at',
                        'updated_at'
                    ]
                ]
            ]);
    }

    public function testGetGenreByIdOrName() {
        $genre = Genre::factory()->create();
        $this->get('/api/genre/'.$genre->id);
        $this->response
            ->assertStatus(200)
            ->assertJson([
                'id' => $genre->id,
                'name' => $genre->name
            ]);

        // $this->get('/api/genre/'.$genre->name);
        // $this->response
        //     ->assertStatus(200)
        //     ->assertExactJson([
        //         'id' => $genre->id,
        //         'name' => $genre->name
        //     ]);
    }
    
    public function testUpdateGenre() {
        $id = Genre::all()->random()->id;
        $this->put('/api/genre/'.$id, ['name' => 'seinen']);
        $this->response
            ->assertStatus(200)
            ->assertJson([
                'id' => $id,
                'name' => 'seinen',
            ]);
    }

    public function testDeleteGenre() {
        $id = Genre::factory()->create()->id;
        $this->delete('/api/genre/'.$id);
        $this->response->assertStatus(204);
        // $this->notSeeInDatabse('genres', ['id' => $id]);
    }

    public function testValidationFails() {
        $creator = Genre::factory()->create();
        $this->post('/api/genre', ['name' => $creator->name]);
        $this->response
            ->assertStatus(422)
            ->assertJsonStructure([
                #TODO: write json structure
            ]);
    }

    public function testNotFound() {
        $name = 'notGenre';
        $id = 964;
        // $this->notSeeInDatabse('genres', ['id' => $id]);
        $this->get('/api/genre/'.$id);
        $this->response
            ->assertStatus(404);

        // $this->notSeeInDatabase('genres', ['name' => $name]);
        // $this->get('/api/genre/'.$name);
        // $this->response
        //     ->assertStatus(404);
    }
}
