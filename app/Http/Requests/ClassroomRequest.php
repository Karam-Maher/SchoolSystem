<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassroomRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'List_Classes.*.name_class' => 'required',
            'List_Classes.*.name_class_en' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name_class.required' => trans('validation.required'),
            'name_class_en.required' => trans('validation.required'),
        ];
    }
}
