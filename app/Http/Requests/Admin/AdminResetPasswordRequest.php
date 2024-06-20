<?php

    namespace App\Http\Requests\Admin;

    use Illuminate\Foundation\Http\FormRequest;

    class AdminResetPasswordRequest extends FormRequest
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
                'email' => [ 'required' , 'email' , 'max:255' , 'exists:admins,email' ] ,
                'password' => [ 'required' , 'min:8','string','confirmed' ] ,
                'password_confirmation' => [ 'required' , 'same:password'] ,
            ];
        }
    }
