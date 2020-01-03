<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'content', 'published'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
