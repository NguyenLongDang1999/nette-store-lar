<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BrandRequest extends FormRequest
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
            'name' => [
                'required',
                'min:3',
                'max:50',
                Rule::unique('brand')->ignore($this->id)
            ],
            'slug' => 'nullable',
            'status' => 'nullable',
            'image_uri' => 'image|mimes:jpg,jpeg,png,gif|max:2048',
            'description' => 'max:160',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'required' => __('trans.validation.required'),
            'min' => __('trans.validation.min.string'),
            'max' => __('trans.validation.max.string'),
            'unique' => __('trans.validation.unique'),
            'image' => __('trans.validation.image'),
            'mimes' => __('trans.validation.mimes'),
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => __('trans.brand.title'),
            'slug' => __('trans.slug'),
            'image_uri' => __('trans.create.image'),
            'description' => __('trans.description'),
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'status' => $this->status ?? config('constants.STATUS_ACTIVE'),
            'slug' => str()->slug($this->name)
        ]);
    }
}
