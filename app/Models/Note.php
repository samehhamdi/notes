<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comments;

class Note extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the comments for the blog note.
     */
    public function comments()
    {
        return $this->hasMany(Comments::class);
    }
}
