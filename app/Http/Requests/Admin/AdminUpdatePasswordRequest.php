<?php

    namespace App\Http\Requests\Admin;

    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Validation\ValidationException;

    class AdminUpdatePasswordRequest extends FormRequest
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
                'current_password' => [ 'required' , 'max:255' ] ,
                'password' => [ 'required' , 'confirmed' , 'max:255' , 'min:8' ] ,
                'password_confirmation' => [ 'required' ] ,
            ];

        }

//        if I'm want validation rules for current password

//        public function withValidator( $validator ): void
//        {
//            $validator->after(function ($validator) {
//                if ( !Hash::check($this->current_password , Auth::guard('admin')->user()->password)) {
//                    $validator->errors()->add('current_password', __('The old password is not match'));
//                }
//            });
//        }
    }
