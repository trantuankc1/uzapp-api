<?php

namespace Modules\Admin\Http\Requests\Product;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
            'categoryId' => 'required',
            'productName' => 'required|max:255',
            'productPrice' => 'required|integer|max:1000000000',
            'amount' => 'required|integer|max:1000000000',
            /*'code' => [
                Rule::unique(Product::class, 'code')->ignore($this->id)
            ]*/
        ];
    }

    /**
     * Message validate filed.
     *
     * @return array
     */
}
