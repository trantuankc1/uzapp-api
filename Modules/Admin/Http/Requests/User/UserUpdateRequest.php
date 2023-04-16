<?php

namespace Modules\Admin\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest {
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
            //
            'person_name' => 'required',
            'mobile_phone'=>'required|digits:10',
            'email' => [
                'required',
                'regex:/(.+)@(.+)\.(.+)/i',
                Rule::unique('users', 'email')->ignore($this->id),
            ],
            'birthday' => 'nullable|date_format:Y-m-d|before:today',
        ];
    }
}
