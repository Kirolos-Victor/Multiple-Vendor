<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class langRequest extends FormRequest
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
        return [
            'name'=>'required|string|max:100',
            'abbreviation'=>'required|string|max:10',
            'direction'=>'required|in:rtl,ltr',
        ];
    }
    public function messages()
    {
        return[
          'required'=>'هذا الحقل مطلوب',
            'in'=>'القيم المدخلة غير صحيحة',
            'string'=>' يجب ان يكون احرف',
            'name.max'=>'الاسم يجب الا يزيد عن مئه حرف',
            'abbreviation.max'=>'الاختصار يجب ان لا يزيد عن عشره احرف',

        ];
    }
}
