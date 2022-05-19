<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
     * @return array<string, mixed>
     */
    public function rules()
    {
        // Execute the validation if the request method is PUT
        if($this->isMethod('PUT')) {
            // Get current book id
            $book = \App\Models\Book::first($this->route('branch'));

            return [
                'title'     => ['bail', 'required', 'string', Rule::unique('books', 'title')->ignore($book['id'])],
                'author'    => 'bail|required|string'
            ];
        }

        // Execute the validation if the request method is POST
        return [
            'title'     => 'bail|required|string|unique:books,title',
            'author'    => 'bail|required|string'
        ];
    }
}
