<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class mainCategoryRequest extends FormRequest
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
            'name'=>'required|string|max:100|unique:main_categories',
            'translation_language'=>'required|string|max:10|unique:main_categories',
            'photo'=>'required|mimes:JPG,JPEG,PNG',
        ];
    }
    public function messages()
    {
        return[
          'required'=>'هذا الحقل مطلوب',
            'string'=>' يجب ان يكون احرف',
            'name.max'=>'الاسم يجب الا يزيد عن مئه حرف',
            'translation_language.max'=>'الاختصار يجب ان لا يزيد عن عشره احرف',

        ];
    }
}
