<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNoteRequest;
use App\Http\Requests\SearchNoteRequest;
use App\Models\Note;
use App\Repositories\NoteRepository;

class NoteController extends Controller
{
    public function __construct(private readonly NoteRepository $noteRepository)
    {

    }

    public function index()
    {
        $notes = $this->noteRepository->paginate();
        return view('notes', compact('notes'));
    }

    public function store(CreateNoteRequest $request)
    {
        $this->noteRepository->insert($request->note);
        return redirect('/');
    }

    public function destroy(Note $note)
    {
        $this->noteRepository->destroy($note);
        return back();
    }

    public function search(SearchNoteRequest $request)
    {
        $notes = $this->noteRepository->search($request->validated('keyword'));
        return view('notes', compact('notes'));
    }
}
