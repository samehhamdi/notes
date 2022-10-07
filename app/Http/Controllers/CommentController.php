<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\Comments;
use DB;

class CommentController extends Controller
{

    /**
     * Store a newly created resource in storage.
     * 
     * @param Note $note
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Note $note , Request $request)
    {
        $request->validate([
            'comment' => 'required'
        ]);
        $comment = new Comments;
        $comment->comment = $request->comment;
        $note->comments()->save($comment);
        return redirect('show/'.$note->slug)->with('message' ,'Comment added succefully ! ');
    }

}
