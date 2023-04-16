<?php

namespace Modules\Admin\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'category_name' => 'required|max:100|unique:categories',
            'note' => 'max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Please enter the category name',
        ];
    }
}
