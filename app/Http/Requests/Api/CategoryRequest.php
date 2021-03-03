<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return \Gate::authorize('isAuthor');
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
        ];
    }

    function messages() {
        return [
            'id.required' => __('The item ID is missing'),
            'name.required' => __('Specify a name'),
            'name.max' => __('Name too long'),
            'description.max' => __('Description too long'),
        ];
    }

}
