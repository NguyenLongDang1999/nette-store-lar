<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'min:3',
                'max:50',
                Rule::unique('category')->ignore($this->id)
            ],
            'slug' => 'nullable',
            'status' => 'nullable',
            'popular' => 'nullable',
            'image_uri' => 'image|mimes:jpg,jpeg,png,gif|max:2048',
            'parent_id' => 'required',
            'description' => 'max:160',
            'meta_title' => 'max:60',
            'meta_keyword' => 'max:60',
            'meta_description' => 'max:160',
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
            'name' => __('trans.category.title'),
            'slug' => __('trans.slug'),
            'parent_id' => __('trans.category.parent_id'),
            'image_uri' => __('trans.create.image'),
            'description' => __('trans.description'),
            'meta_title' => __('trans.seo.meta_title'),
            'meta_keyword' => __('trans.seo.meta_keyword'),
            'meta_description' => __('trans.seo.meta_description'),
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'status' => $this->status ?? config('constants.STATUS_ACTIVE'),
            'popular' => $this->status ?? config('constants.POPULAR_INACTIVE'),
            'slug' => str()->slug($this->name)
        ]);
    }
}
