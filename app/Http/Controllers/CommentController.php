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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Note $note , Request $request)
    {
        $request->validate([
            'comment' => 'required'
        ]);
        $comment = new Comments;
        $comment->comment = $request->comment;
        $comment->comment = $request->comment;
        $note->comments()->save($comment);
        return redirect('show/'.$note->slug)->with('message' ,'Comment added succefully ! ');
    }

}
