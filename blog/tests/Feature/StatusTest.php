<?php

namespace Tests\Feature;

use App\Models\Status;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use TestCase;

class StatusTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetStatuses()
    {
        $this->get('/api/status');
        $this->response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'code',
                        'name',
                        'created_at',
                        'updated_at'
                    ]
                ]
            ]);
    }

    public function testGetStatusByIdOrName() {
        $status = Status::all()->random();
        $this->get('/api/status/'.$status->id);
        $this->response
            ->assertStatus(200)
            ->assertJson([
                'id' => $status->id,
                'code' => $status->code,
                'name' => $status->name
            ]);

        // $this->get('/api/Status/'.$status->name);
        // $this->response
        //     ->assertStatus(200)
        //     ->assertExactJson([
        //         'id' => $status->id,
        //         'code' => $status->code,
        //         'name' => $status->name
        //     ]);
    }
    
    public function testUpdateStatus() {
        $status = Status::all()->random();
        // dd($status);
        $this->put('/api/status/'.$status->id, ['name' => 'On Hold']);
        $this->response
            ->assertStatus(200)
            ->assertJson([
                'id' => $status->id,
                'code' => $status->code,
                'name' => 'On Hold',
            ]);
    }

    public function testDeleteStatus() {
        $id = Status::all()->random()->id;
        // dd($id);
        $this->delete('/api/status/'.$id);
        $this->response->assertStatus(204);
        // $this->notSeeInDatabse('statuss', ['id' => $id]);
    }

    public function testValidationFails() {
        $status = Status::all()->random();
        $this->post('/api/status', ['code' => $status->code, 'name' => $status->name]);
        $this->response
            ->assertStatus(422)
            ->assertJsonStructure([
                #TODO: write json structure
            ]);
    }

    public function testNotFound() {
        $name = 'notStatus';
        $id = 964;
        // $this->notSeeInDatabse('statuses', ['id' => $id]);
        $this->get('/api/status/'.$id);
        $this->response
            ->assertStatus(404);

        // $this->notSeeInDatabase('statuses', ['name' => $name]);
        // $this->get('/api/status/'.$name);
        // $this->response
        //     ->assertStatus(404);
    }
}
