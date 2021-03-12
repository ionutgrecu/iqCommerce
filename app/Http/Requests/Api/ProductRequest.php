<?php

namespace App\Http\Requests\Api;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return Gate::authorize('isAuthor');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'id' => 'integer|min:0',
            'name' => 'required|max:255',
            'description' => 'max:65535',
            'product_category_id' => 'integer|min:0',
            'product_vendor_id' => 'integer|min:0',
            'price' => 'required|numeric|min:0',
        ];
    }

}
