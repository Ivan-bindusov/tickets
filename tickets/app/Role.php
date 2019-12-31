<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Permission;

class Role extends Model
{
    protected $fillable = ['title', 'slug'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permissions');
    }
}
