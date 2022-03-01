<?php

namespace Tests\Feature;

use App\Models\Chapter;
use App\Models\Title;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use TestCase;

class ChapterTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetChapters()
    {
        $this->get('/api/chapter');
        $this->response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    [
                        'id',
                        'num',
                        'name',
                        'title_id',
                        'created_at',
                        'updated_at'
                    ]
                ]
            ]);
    }

    public function testGetChapterById() {
        $chapter = Chapter::factory()->create();
        $this->get('/api/chapter/'.$chapter->id);
        $this->response
            ->assertStatus(200)
            ->assertJson([
                'id' => $chapter->id,
                'num' => $chapter->num,
            ]);
    }
    
    public function testUpdatechapter() {
        $titleId = Title::all()->random()->id;
        $id = Chapter::factory()->create()->id;
        $this->put('/api/chapter/'.$id, ['num' => 964, 'name' => 'chapter name', 'title_id' => $titleId]);
        $this->response
            ->assertStatus(200)
            ->assertJson([
                'id' => $id,
                'name' => 'chapter name',
                'title_id' => $titleId
            ]);
    }

    public function testDeletechapter() {
        $id = Chapter::factory()->create()->id;
        $this->delete('/api/chapter/'.$id);
        $this->response->assertStatus(204);
        // $this->assertDatabaseMissing('chapters', ['id' => $id]);
    }

    // public function testValidationFails() {
    //     $chapter = Chapter::factory()->create();
    //     $this->post('/api/chapter', ['num' => $chapter->num, 'title_id' => $chapter->title_id]);
    //     $this->response
    //         ->assertStatus(422)
    //         ->assertJsonStructure([
    //             #TODO: write json structure
    //         ]);
    // }

    public function testNotFound() {
        $id = 964;
        // $this->notSeeInDatabse('chapters', ['id' => $id]);
        $this->get('/api/chapter/'.$id);
        $this->response
            ->assertStatus(404);
    }
}
