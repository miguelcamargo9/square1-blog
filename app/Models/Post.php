<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = ['title', 'description', 'publication_date', 'user_id'];

    public function user()
    {
        return $this->belongsTo("App\User", 'user_id');
    }
}
