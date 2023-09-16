<?php

namespace Tests\Feature;

use App\Models\Note;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SearchNoteTest extends TestCase
{
    use RefreshDatabase;

    protected const ENDPOINT = '/search';

    public function setUp(): void
    {
        parent::setUp();
        Note::factory()->count(10)->create();
    }

    public function test_should_return_error_when_keyword_is_missing(): void
    {
        $this->followingRedirects();
        $response = $this->get(self::ENDPOINT);
        $response->assertSee('The keyword field is required.');
    }

    public function test_should_return_error_when_keyword_is_too_short()
    {
        $this->followingRedirects();
        $response = $this->get(self::ENDPOINT.'?keyword=c');
        $response->assertSee('The keyword field must be at least 3 characters.');
    }

    public function test_should_see_the_result_when_keyword_is_valid()
    {
        $note = Note::factory()->create();
        $response = $this->get(self::ENDPOINT.'?keyword='.$note->content);
        $response->assertSee($note->content);
    }

    public function test_should_see_the_empty_result_when_there_is_no_match_with_keyword()
    {
        $text = time();
        $response = $this->get(self::ENDPOINT.'?keyword='.$text);
        $response->assertSee('There are no results.');
    }
}
