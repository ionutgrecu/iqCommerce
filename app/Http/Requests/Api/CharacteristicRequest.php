<?php

namespace App\Http\Requests\Api;

use App\Models\CategoryCharacteristic;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use function ___;

class CharacteristicRequest extends FormRequest {

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
            'category_id' => 'min:0',
            'type' => 'in:' . implode(',', CategoryCharacteristic::getPossibleEnumValues('type')),
        ];
    }

    function messages() {
        return [
            'id.required' => __('The item ID is missing'),
            'name.required' => __('Specify a name'),
            'name.max' => __('Name too long'),
        ];
    }

}
