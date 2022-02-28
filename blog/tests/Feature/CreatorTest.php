<?php

namespace Tests\Feature;

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use TestCase;

class CreatorTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetCreators()
    {
        $this->get('/api/creators');
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
                ],
                'total',
                'per_page',
                'current_page',
                'last_page',
                'first_page_url',
                'last_page_url',
                'next_page_url',
                'prev_page_url',
                'path',
                'from',
                'to'
            ]);
    }

    public function testGetAuthors() {
        $this->get('/api/creators?type=author');
        $this->response
            ->assertStatus(200)
            ->assertExactJson([
                'type' => 'author',
            ]);
    }
}
