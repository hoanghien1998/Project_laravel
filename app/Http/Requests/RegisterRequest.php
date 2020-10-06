<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return boolean
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'email' => 'required|string|email|max:100|unique:users',
            'first_name' => 'required|string|between:2,100',
            'last_name' => 'required|string|between:2,100',
            'password' => 'required|string|min:6',
            'gender' => 'required|string|in:Male,Female',
        ];
    }
}
