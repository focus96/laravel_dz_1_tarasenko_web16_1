<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Parsedown;

class News extends Model {

    //
    protected $fillable = [
        'title', 'slug', 'content', 'user_id',
    ];

    /**
     * Связь с таблицей пользователей
     * @return type Model user
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function setTitleAttribute($value) {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }

    // удаляем опасный код
    public function setContentAttribute($value) {
        $this->attributes['content'] = clean($value);
    }

    // преобразуем markdown в html
    public function getMarkdownContentAttribute() {
        return (new Parsedown)->text($this->attributes['content']);
    }

}
