<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GradeRequest extends FormRequest
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
            'name' => 'required|string|min:5|max:255|unique:grades,name',
            'notes' => 'required|string|min:3',
        ];
    }
    public function messages()
    {
        return [
           'name.required' => trans('validation.required'),
           'name.string' => trans('validation.string'),
           'name.min' => trans('validation.min'),
           'name.max' => trans('validation.max'),
           'name.unique' => trans('validation.unique'),

           'notes.required' => trans('validation.required'),
           'notes.string' => trans('validation.string'),
           'notes.min' => trans('validation.min'),
        ];
    }
}
