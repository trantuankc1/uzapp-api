<?php

namespace Modules\Admin\Http\Requests\AdminLogin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminLoginRequest extends FormRequest
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
            'email' => 'required|string',
            'password' => 'required|string',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'email' => 'Please enter the email address.',
            'password' => 'Please enter the email password.',
        ];
    }
}
