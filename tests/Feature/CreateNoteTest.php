<?php

namespace Tests\Feature;

use App\Models\Note;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateNoteTest extends TestCase
{
    use RefreshDatabase;

    protected const ENDPOINT = '/';

    public function test_should_return_error_when_note_is_missing(): void
    {
        $this->followingRedirects();
        $response = $this->post(self::ENDPOINT);
        $response->assertSee('The note field is required.');
        $this->assertDatabaseCount(Note::class, 0);
    }

    public function test_should_return_error_when_note_is_not_string()
    {
        $this->post(self::ENDPOINT, ['note' => true]);
        $this->assertDatabaseCount(Note::class, 0);
    }

    public function test_should_create_new_note_when_data_is_valid()
    {
        $this->post(self::ENDPOINT, ['note' => 'sample']);
        $this->assertDatabaseCount(Note::class, 1);
        $this->assertDatabaseHas(Note::class, [
            'content' => 'sample'
        ]);
    }
}
