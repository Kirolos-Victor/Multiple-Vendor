<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class loginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //allow user to login from here true to allow authorization false to disable
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                'email'=>'required|email',
                'password'=>'required '
        ];
    }
    public function messages()
    {
        return [
            'email.required'=>'البريد الالكترؤنى مطلوب',
            'email.email'=>'ازخل بريد الكترونى صالح',
            'password.required'=>'كلمة المرور مطلوبة'
        ];
    }
}
