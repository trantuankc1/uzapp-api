<?php

namespace Modules\Api\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     properties={
 *          @OA\Property(property="email", type="string"),
 *          @OA\Property(property="password", type="string")
 *     }
 * )
 */
class UserUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'person_name' => 'required|max:255',
            'first_name' => 'max:64',
            'first_kana_name' => 'max:64',
            'last_name' => 'max:64',
            'last_kana_name' => 'max:64',
            'zipcode' => 'max:10',
            'state' => 'max:64',
            'city' => 'max:64',
            'town' => 'max:64',
            'address' => 'max:64',
            'phone' => 'max:64',
            'password' => 'max:255',
            'birthday' => 'nullable|date_format:Y-m-d|before:today',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }
}
