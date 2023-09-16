<?php

namespace Tests\Feature;

use App\Models\Note;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexNoteTest extends TestCase
{
    use RefreshDatabase;

    protected const ENDPOINT = '/';

    public function test_should_see_the_empty_result_when_no_notes_created()
    {
        $response = $this->get(self::ENDPOINT);
        $response->assertStatus(200);
        $response->assertSee('There are no results.');
    }

    public function test_should_see_the_result_order_by_latest_when_there_is_created_notes()
    {
        Note::factory()->count(10)->create();
        $notes = Note::query()->latest()->pluck('content')->toArray();
        $response = $this->get(self::ENDPOINT);
        $response->assertSeeTextInOrder($notes);
    }

    public function test_should_see_the_result_order_by_oldest_date_when_there_is_created_notes_and_sorted()
    {
        Note::factory()->count(10)->create();
        $notes = Note::query()->orderBy('created_at', 'asc')->pluck('content')->toArray();
        $response = $this->get(self::ENDPOINT.'?orderByDate=asc');
        $response->assertSeeTextInOrder($notes);
    }

    public function test_should_see_error_when_orderByDate_is_invalid()
    {
        $this->followingRedirects();
        Note::factory()->count(10)->create();
        $response = $this->get(self::ENDPOINT.'?orderByDate=invalid');
        $response->assertSee('The selected order by date is invalid.');
    }

    public function test_should_see_pagination_when_number_of_created_notes_is_huge()
    {
        Note::factory()->count(50)->create();
        $response = $this->get(self::ENDPOINT);
        $response->assertSee('page=2');
    }
}
