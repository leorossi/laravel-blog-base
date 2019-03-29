<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function scopePublished($query) {
        return $query->where('state', '=', 'published');
    }
    
    public function scopeDraft($query) {
        return $query->where('state', '=', 'draft');
    }
}
