<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Support\Str;

class NotesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of all notes.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = Note::where('user_id', auth()->user()->id)
            ->orwhere('ispublic',true)
            ->orderBy('updated_at', 'DESC')
            ->paginate(4);

        return view('notes.index', compact('notes'));
    }

    /**
     * Show the form for creating a new note.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('notes.create');
    }

    /**
     * Store a newly created note in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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

        return redirect('/')->with("Note added succefully ! ");
    }

    /**
     * Show the form for editing the specified note.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        return view('notes.edit', compact('note'));
    }

    /**
     * Update the specified note.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        $note->title = $request->title;
        $note->body = $request->body;

        $note->save();

        return 'Saved!';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        $comments = Comments::getComents($note);
        return view('notes.show', ['note' =>$note ,
                                         'comments' => $comments]);
    }
    /**
     * Delete the specified note.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        $note->delete();
        return redirect('/')->with("Note deleted succefully ! ");
    }

}
