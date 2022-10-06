<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Note;

class Comments extends Model
{
    use HasFactory;

    /**
     * Display a listing of all comments for specific note.
     *
     * @param \App\Models\Note $note
     * @return mixed
     */
    public static function getComents(Note $note)
    {
        $comments = self::where('note_id', $note->id)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        return $comments;
    }
}
