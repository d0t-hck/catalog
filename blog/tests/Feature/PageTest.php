<?php

namespace Tests\Feature;

use App\Models\Page;
use App\Models\Chapter;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use TestCase;

class PageTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetPages()
    {
        $this->get('/api/page');
        $this->response
            ->assertStatus(200)
            ->assertJsonStructure([
                [
                    'id',
                    'chapter_id',
                    'page',
                    'created_at',
                    'updated_at'
                ],
            ]);
    }

    public function testGetPageByIdOrName() {
        $page = Page::factory()->create();
        $this->get('/api/page/'.$page->id);
        $this->response
            ->assertStatus(200)
            ->assertJson([
                'id' => $page->id,
                'chapter_id' => $page->chapter_id,
                'page' => $page->page
            ]);
    }
    
    public function testUpdatePage() {
        $chapterId = Chapter::all()->random()->id;
        $page = Page::factory()->create();
        $this->put('/api/page/'.$page->id, ['chapter_id' => $chapterId]);
        $this->response
            ->assertStatus(200)
            ->assertJson([
                'id' => $page->id,
                'chapter_id' => $chapterId,
                'page' => $page->page
            ]);
    }

    public function testDeletePage() {
        $id = Page::factory()->create()->id;
        $this->delete('/api/page/'.$id);
        $this->response->assertStatus(204);
        // $this->notSeeInDatabse('pages', ['id' => $id]);
    }

    public function testValidationFails() {
        $page = Page::factory()->create();
        $this->post('/api/page', ['title_id' => $page->chapter_id]);
        $this->response
            ->assertStatus(422)
            ->assertJsonStructure([
                #TODO: write json structure
            ]);
    }

    public function testNotFound() {
        $id = 1964;
        // $this->notSeeInDatabse('pages', ['id' => $id]);
        $this->get('/api/page/'.$id);
        $this->response
            ->assertStatus(404);
    }
}
