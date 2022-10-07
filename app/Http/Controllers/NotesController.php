<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Support\Str;
use http\Exception;

class NotesController extends Controller
{
    /**
     * Construct
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of all notes.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function index()
    {
        $notes = Note::where('user_id', auth()->user()->id)
            ->orwhere('ispublic',true)
            ->orderBy('updated_at', 'DESC')
            ->paginate(4);
        if (!$notes) {
            throw new \Exception("An Exception was raised please contact the Administrator !!");
        }
        return view('notes.index', compact('notes'));
    }

    /**
     *
     * Show the form for creating a new note.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('notes.create');
    }

    /**
     * Store a newly created note in database.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'body'  => 'required'
        ]);
        $request->ispublic == NULL ? $ispublic = false : $ispublic = true ;
        $note = Note::create([
            'user_id' => $request->user()->id,
            'title'   => $request->title,
            'slug'    => str($request->title) . str::random(10),
            'body'    => $request->body,
            'ispublic'    => $ispublic
        ]);

        return redirect('/')->with('message' ,'Note added succefully ! ');
    }

    /**
     * Show the form for editing the specified note.
     *
     * @param Note $note
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Note $note)
    {
        return view('notes.edit', compact('note'));
    }

    /**
     * Update the specified note.
     *
     * @param Request $request
     * @param Note $note
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function update(Request $request, Note $note)
    {
        $note->title = $request->title;
        $note->body = $request->body;
        if($note->save())
            return redirect('/')->with('message' ,'Note updated succefully ! ');
        else
            throw new \Exception("An Exception was raised please contact the Administrator !!");

    }

    /**
     * Display the specified resource.
     *
     * @param Note $note
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function show(Note $note)
    {
        $comments = Comments::getComents($note);
        if (!$comments) {
            throw new \Exception("An Exception was raised please contact the Administrator !!");
        }
        return view('notes.show', ['note' =>$note ,
                                         'comments' => $comments]);
    }

    /**
     * Delete the specified note.
     *
     * @param Note $note
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(Note $note)
    {
        if($note->delete())
            return redirect('/')->with('message' ,'Note deleted succefully ! ');
        else
            throw new \Exception("An Exception was raised please contact the Administrator !!");
    }

}
