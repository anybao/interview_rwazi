<?php

namespace App\Repositories;

use App\Models\Note;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class NoteRepository
{
    public function paginate(): LengthAwarePaginator
    {
        return Note::query()->latest()->paginate();
    }

    public function insert(string $content): Model|Builder
    {
        return Note::query()->create([
            'content' => $content
        ]);
    }

    public function destroy(Note $note): ?bool
    {
        return $note->delete();
    }

    public function search(string $keyword): LengthAwarePaginator
    {
        return Note::query()->where('content', 'LIKE', '%'.$keyword.'%')->latest()->paginate();
    }
}
