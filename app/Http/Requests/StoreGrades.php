<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGrades extends FormRequest
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
            'name_ar' => 'required|min:3|unique:grades,name->ar,' . $this->id,
            'name_en' => 'required|min:3|unique:grades,name->an,' . $this->id,
        ];
    }

    public function messages(): array
    {
        return [
            'name_ar.required' => __('validation.required'),
            'name_ar.min' => __('validation.min'),
            'name_en.required' => __('validation.required'),
            'name_en.min' => __('validation.min'),
            'name_ar.unique' => __('validation.exists_trans'),
            'name_en.unique' => __('validation.exists_trans'),
        ];
    }
}
