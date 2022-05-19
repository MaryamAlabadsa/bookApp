<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLibraryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'is_completed' => 'required|numeric|in:0,1,2',
            'is_download' => 'required|numeric|in:0,1',
            'user_id' => 'exists:users,id',
            'book_id' => 'required|exists:books,id',

        ];
    }
}
