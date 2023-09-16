<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNoteRequest;
use App\Http\Requests\SearchNoteRequest;
use App\Models\Note;
use App\Repositories\NoteRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class NoteController extends Controller
{
    public function __construct(private readonly NoteRepository $noteRepository)
    {

    }

    /**
     * Get list of note sorted by latest created date
     *
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function index(): Application|View|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $notes = $this->noteRepository->paginate();
        return view('notes', compact('notes'));
    }

    /**
     * Store note to Database
     *
     * @param CreateNoteRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|Application|RedirectResponse|Redirector
     */
    public function store(CreateNoteRequest $request): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $this->noteRepository->insert($request->note);
        return redirect('/');
    }

    /**
     * Delete note from Database
     *
     * @param Note $note
     * @return RedirectResponse
     */
    public function destroy(Note $note): RedirectResponse
    {
        $this->noteRepository->destroy($note);
        return back();
    }

    /**
     * Search note by its text
     *
     * @param SearchNoteRequest $request
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function search(SearchNoteRequest $request): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $notes = $this->noteRepository->search($request->validated('keyword'));
        return view('notes', compact('notes'));
    }
}
