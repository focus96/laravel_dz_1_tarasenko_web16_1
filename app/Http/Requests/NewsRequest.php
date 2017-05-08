<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\News;

class NewsRequest extends FormRequest {

    /**
     * Allowed methods for the request.
     * 
     * @var array
     */
    protected $allowedMethods = [
        'store' => ['post'],
        'update' => ['put', 'patch']
    ];

    /**
     * Current method.
     * 
     * @var string|null
     */
    protected $currentMethod = null;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {

        if (in_array($this->currentMethod, $this->allowedMethods['store'])) {
            return $this->authorizeStore();
        } else if (in_array($this->currentMethod, $this->allowedMethods['update'])) {
            return $this->authorizeUpdate();
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        $this->currentMethod = \Illuminate\Support\Str::lower($this->getMethod());

        if (in_array($this->currentMethod, $this->allowedMethods['store'])) {
            return $this->validateStore();
        } else if (in_array($this->currentMethod, $this->allowedMethods['update'])) {
            return $this->validateUpdate();
        }
    }

    /**
     * Authorize for store.
     * 
     * @return boolean
     */
    public function authorizeStore() {
        return true;
    }

    /**
     * Authorize for update.
     * 
     * @return boolean
     */
    public function authorizeUpdate() {
        (News::where('id', request()->id)
                        ->where('user_id', auth()->id())->exists()) ? true : abort(403);
        return true;
    }

    /**
     * Validate POST request.
     * 
     * @return array
     */
    public function validateStore() {
        return [
            'title' => 'required|unique:news', // не забываем проверять на уникальность
            'content' => 'required|max:10',
        ];
    }

    /**
     * Validate PUT, PATH request.
     * 
     * @return array
     */
    public function validateUpdate() {
        return [
            'title' => 'required|unique:news,title,' . request()->id,
            'content' => 'required|max:10',
        ];
    }

}
