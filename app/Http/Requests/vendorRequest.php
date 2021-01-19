<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class vendorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('vendor');
        $rules=[
            'name' => 'required|string|max:100',
            'category_id'=>'required|exists:main_categories,id',
            'address'   => 'required|string|max:500',

        ];

        if ($this->getMethod() == 'POST') {
            $rules += [
                'mobile'=>'required|unique:vendors,mobile',
                'email'=>'required|unique:vendors,email|email',
                'logo_image'=>'required|mimes:jpeg,jpg,png',
                'password'=>'required|min:6',
                ];
        }
        else{
            $rules += [
                'mobile'=>'required|unique:vendors,mobile,'.$id,
                'email'=>'required|email|unique:vendors,email,'.$id,
                'password' => 'sometimes|nullable|min:8',
                'logo_image'=>'sometimes|nullable|mimes:jpeg,jpg,png',

            ];
        }

        return $rules;
    }
    public function messages()
    {
        return [
            'required'  => 'هذا الحقل مطلوب ',
            'max'  => 'هذا الحقل طويل',
            'min'  => 'هذا الحقل قصير',
            'category_id.exists'  => 'القسم غير موجود ',
            'email.email' => 'ضيغه البريد الالكتروني غير صحيحه',
            'address.string' => 'العنوان لابد ان يكون حروف او حروف وارقام ',
            'name.string'  =>'الاسم لابد ان يكون حروف او حروف وارقام ',
            'email.unique' => 'البريد الالكتروني مستخدم من قبل ',
            'mobile.unique' => 'رقم الهاتف مستخدم من قبل ',
        ];
    }
}
