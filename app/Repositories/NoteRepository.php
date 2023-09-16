<?php

namespace App\Repositories;

use App\Models\Note;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class NoteRepository
{
    /**
     * Return list of note paginated
     *
     * @param array $params
     * @return LengthAwarePaginator
     */
    public function paginate(array $params): LengthAwarePaginator
    {
        $orderByDate = Arr::get($params, 'orderByDate', 'desc');

        return Note::query()->orderBy('created_at', $orderByDate)->paginate();
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
