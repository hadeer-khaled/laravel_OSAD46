<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'author_id']; //for mass assignment

    // protected $guarded = [];

    // protected $hidden = [];

    public function author(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        
        return $this->belongsTo(User::class, 'author_id');
    }
}
