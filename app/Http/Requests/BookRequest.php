<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'name' => 'required|string',
            'description' => 'nullable|string',
            'published_date' => 'nullable|date',
            'no_of_pages' => 'nullable|integer',
            'status' => 'required|string',
            'author_id' => 'required|exists:authors,id',
        ];
    }
}
