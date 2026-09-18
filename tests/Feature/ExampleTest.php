<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Note;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_notes_endpoint_returns_successful_response(): void
    {

        $response = $this->getJson('/notes');

        $response->assertStatus(200);

        $response->assertJson(['data' => []]);
    }

    public function test_note_successful_created(): void
    {
        $response = $this->postJson('/notes', ['title' => 'Primeira nota','content' => 'Esse foi um post bem sucedido para a api.']);

        $response->assertStatus(201);

        $response->assertJson(['title' => 'Primeira nota','content' => 'Esse foi um post bem sucedido para a api.']);

        $this->assertDatabaseHas(Note::class, [
            'title' => 'Primeira nota',
            'content' => 'Esse foi um post bem sucedido para a api.',
        ]);
    }
}
