<?php

namespace App\Http\Requests;

use App\Rules\RequiredPaymentByAge;
use Illuminate\Foundation\Http\FormRequest;


class CustomValidationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'age' => ['required', 'integer', 'min:0',],
            'payment' => ['required', 'integer', new RequiredPaymentByAge(':attribute')],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'age' => '年齢',
            'payment' => '支払額',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'age.required' => ':attribute は必須です。',
            'age.integer' => ':attribute は整数でなければなりません。',
            'age.min' => ':attribute は0以上でなければなりません。',
            'payment.required' => ':attribute は必須です。',
            'payment.integer' => ':attribute は整数でなければなりません。',
        ];
    }
}
