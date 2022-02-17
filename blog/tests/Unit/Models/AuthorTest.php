<?php


use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class AuthorTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    /**
     * authors [GET]
     */
    public function test_should_return_all_authors(){
        $this->get('api/authors')
            ->seeStatusCode(200)
            ->seeJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'bio',
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
}
