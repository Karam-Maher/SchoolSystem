<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeacher extends FormRequest
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
            'email' => 'required|email|unique:teachers,email,'.$this->id,
            'password' => 'required|min:8',
            'name_ar' => 'required',
            'name_en' => 'required',
            'specialization_id' => 'required',
            'gender_id' => 'required',
            'joining_date' => 'required|date|date_format:y-m-d',
            'address' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'email.required' => trans('validation.required'),
            'email.email' => trans('validation.email'),
            'email.unique' => trans('validation.unique'),
            'password.required' => trans('validation.required'),
            'name_ar.required' => trans('validation.required'),
            'name_en.required' => trans('validation.required'),
            'specialization_id.required' => trans('validation.required'),
            'gender_id.required' => trans('validation.required'),
            'joining_date.date' => trans('validation.date'),
            'joining_date.required' => trans('validation.required'),
            'address.required' => trans('validation.required'),
        ];
    }
}
