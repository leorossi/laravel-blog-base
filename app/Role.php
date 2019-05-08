<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const ROLE_ADMIN = 'admin';
    const ROLE_EDITOR = 'editor';
    const ROLE_READER = 'reader';
    
    public function users() {
        return $this->hasMany(User::class);
    }
}
