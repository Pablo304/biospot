<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreComplaintRequest extends FormRequest {

    public function rules(): array {
        return [
            'description' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'address' => 'required'
        ];
    }

    public function authorize(): bool {
        return true;
    }

    public function messages(): array {
        return [
            'description.required' => __('validation.required', ['attribute' => 'descrição']),
            'latitude.required' => __('validation.required', ['attribute' => 'latitude']),
            'longitude.required' => __('validation.required', ['attribute' => 'longitude']),
            'address.required' => __('validation.required', ['attribute' => 'address']),
        ];
    }
}
