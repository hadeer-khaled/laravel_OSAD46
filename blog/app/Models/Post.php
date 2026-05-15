<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['title', 'content', 'author_id', 'image']; //for mass assignment

    // protected $guarded = [];

    // protected $hidden = [];

    public function author():BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
 
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likable');
    }

    public function isLikedBy(User $user)
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    
}
