<?php

namespace App\Repositories;

use App\Models\Note;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class NoteRepository
{
    /**
     * Return list of note paginated
     *
     * @return LengthAwarePaginator
     */
    public function paginate(): LengthAwarePaginator
    {
        return Note::query()->latest()->paginate();
    }

    /**
     * Insert to DB
     *
     * @param string $content
     * @return Model|Builder
     */
    public function insert(string $content): Model|Builder
    {
        return Note::query()->create([
            'content' => $content
        ]);
    }

    /**
     * Remove note
     *
     * @param Note $note
     * @return bool|null
     */
    public function destroy(Note $note): ?bool
    {
        return $note->delete();
    }

    /**
     * Search records by its text
     *
     * @param string $keyword
     * @return LengthAwarePaginator
     */
    public function search(string $keyword): LengthAwarePaginator
    {
        return Note::query()->where('content', 'LIKE', '%'.$keyword.'%')->latest()->paginate();
    }
}
