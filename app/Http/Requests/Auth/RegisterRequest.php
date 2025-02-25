<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\{ValidationRule, Validator};
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class RegisterRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'                  => 'required|string',
            'email'                 => 'required|string|email|unique:users,email',
            'password'              => 'required|string|confirmed',
            'password_confirmation' => 'required|string|same:password',
            'type'                  => 'required',
            'document'              => 'required',
            'address'                => 'sometimes|string',
            'phone'                 => 'sometimes|string',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'errors' => $validator->errors(),
                'status' => true,
            ], Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
