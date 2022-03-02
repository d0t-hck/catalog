<?php

namespace Tests\Feature;

use TestCase;
use App\Models\Creator;
use App\Models\Genre;
use App\Models\Status;
use App\Models\Title;
use Laravel\Lumne\Testing\DatabaseMigrations;
use Laravel\Lumne\Testing\DatabaseTransactions;

class TitleTest extends TestCase
{
    /**
     * @return void
     */
    public function testGetTitles() {
        $this->get('/api/title');
        $this->response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'status_code',
                        'release_year',
                        'description',
                        'author_id',
                        'artist_id',
                        'publisher_id',
                        'normalized_name',
                        'created_at',
                        'updated_at'
                    ]
                ]
            ]);
    }

    // public function testGetTitlesWithSpecificGenre() {
    //     $genre = Genre::all()->random()->name;
    //     $this->get('/api/title?genre='.$genre);
    //     $this->response
    //         ->assertStatus(200)
    //         ->assertExactJson([
    //             'data' => [
    //                 '*' => [
    //                     'genre' => [
    //                         'name' => $genre
    //                     ]
    //                 ]
    //             ]
    //         ]);
    // }

    // public function testGetTitleWithSpecificStatus() {
    //     $status = Status::all()->random()->name;
    //     $this->get('/api/title?status='.$status);
    //     $this->response
    //         ->assertStatus(200)
    //         ->assertJson([
    //             'data' => [
    //                 [
    //                     'status' => [
    //                         'name' => $status
    //                     ]
    //                 ]
    //             ]
    //         ]);
    // }

    // public function testGetTitleWithSpecificGenreAndStatus() {
    //     $genre = Genre::all()->random()->name;
    //     $status = Status::all()->random()->name;
    //     $this->get('/api/title?genre'.$genre.'&status='.$status);
    //     $this->response
    //         ->assertStatus(200)
    //         ->assertJson([
    //             'data' => [
    //                 [
    //                     'genre' => [
    //                         'name' => $genre
    //                     ],
    //                     'status' => [
    //                         'name' => $status
    //                     ]
    //                 ]
    //             ]
    //         ]);
    // }

    public function testUpdateTitle() {
        $title = Title::all()->random();
        $year = $title->release_year+1;
        $author = Creator::where('type', 'Author')->pluck('id')[0];
        $artist = Creator::where('type','Artist')->pluck('id')[0];
        $publisher = Creator::where('type','Publisher')->pluck('id')[0];
        $status = Status::where('code','!=',$title->status_code)->pluck('code')[0];
        $this->put('/api/title/'.$title->id,[
            'name' => 'Test Update',
            'release_year' => $year,
            'description' => 'test update route',
            'author_id' => $author,
            'artist_id' => $artist,
            'publisher_id' => $publisher
        ]);
        // dd($this->response);
        $this->response
            ->assertStatus(200)
            ->assertDatabaseHas('titles',[
                'id'=>$title->id,
                'status_code'=>$status,
                'author_id'=>$author,
                'artist_id'=>$artist,
                'publisher_id'=>$publisher,
                'description'=>'test update route',
                'release_year'=>$title->release_year+1,
                'normalized_name' => 'test_update'
            ]);
    }

    public function testDeleteTitle(){
        $title = Title::factory()->create();
        $this->delete('/api/title/'.$title->id);
        $this->response
            ->assertStatus(204);
        // assertDatabaseMissing('titles', $title);
    }
}
