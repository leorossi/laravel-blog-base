<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    
    protected $fillable = [ 'title', 'body'];
    
    public function scopePublished($query) {
        return $query->where('state', '=', 'published');
    }
    
    public function scopeDraft($query) {
        return $query->where('state', '=', 'draft');
    }
    
    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function comments() {
        return $this->hasMany(Comment::class);
    }
}
