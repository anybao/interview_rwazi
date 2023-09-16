<?php

namespace Tests\Feature;

use App\Models\Note;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteNoteTest extends TestCase
{
    use RefreshDatabase;

    protected const ENDPOINT = '/';

    public function test_should_return_error_when_note_is_missing(): void
    {
        $response = $this->delete(self::ENDPOINT);
        $response->assertStatus(405);
    }

    public function test_should_return_error_when_note_is_invalid()
    {
        $response = $this->delete(self::ENDPOINT.'/invalid');
        $response->assertStatus(404);
    }

    public function test_should_delete_note_when_note_is_valid()
    {
        $note = Note::factory()->create();
        $this->delete(self::ENDPOINT.'/'.$note->id);
        $this->assertDatabaseMissing(Note::class, ['content' => $note->content]);
    }
}
