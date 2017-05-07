<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Связь с таблицей ролей
     * @return type Model roles
     */
    public function roles() {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Связь с таблицей новостей
     * @return type Model news
     */
    public function news() {
        return $this->hasMany(News::class);
    }
}
