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
            'description' => 'max:16777216',
            'product_category_id' => 'integer|min:0',
            'product_vendors_id' => 'integer|min:0',
            'price' => 'required|numeric|gt:0',
        ];
    }
    
    function messages(): array {
        return[
            'name.required'=>__('Type the product name'),
            'product_category_id.min'=>__('Select a category'),
            'product_category_id.integer'=>__('Select a category'),
            'product_vendors_id.min'=>__('Select a vendor'),
            'product_vendors_id.integer'=>__('Select a vendor'),
            'price.required'=>__('Enter a price'),
        ];
    }

}
