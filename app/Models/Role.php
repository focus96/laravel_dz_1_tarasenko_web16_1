<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $timestamps = false;

    /**
     * Связь с таблицей пользователей.
     *
     * @return type Model user
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
