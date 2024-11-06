<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest {

    public function rules(): array {
        return [
            'email' => 'required',
            'password' => 'required'
        ];
    }

    public function authorize(): bool {
        return true;
    }

    public function messages(): array {
        return [
            'email.required' => __('validation.required', ['attribute' => 'email de usuário']),
            'password.required' => __('validation.required', ['attribute' => 'senha']),
        ];
    }
}
