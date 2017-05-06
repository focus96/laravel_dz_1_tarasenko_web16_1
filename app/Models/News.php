<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    //
    
    /**
     * Связь с таблицей пользователей
     * @return type Model user
     */
    public function users() {
        return $this->belongsTo(User::class);
    }
}
