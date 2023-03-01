<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassroomRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'class_name_ar' => 'required|min:3',
            'class_name_en' => 'required|min:3',
            'grade_name' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'class_name_ar.required' => __('validation.required'),
            'class_name_ar.min' => __('validation.min'),
            'class_name_en.required' => __('validation.required'),
            'class_name_en.min' => __('validation.min'),
            'grade_name.required' => __('validation.required')
        ];
    }
}
