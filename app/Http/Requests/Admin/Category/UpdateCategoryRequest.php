<?php

namespace App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            'category_id' => 'nullable|integer|exists:categories,id',
            'slug' => 'required|unique:categories,slug,' . $this->category->id . ',id',
            'title' => 'required',
            'description' => 'nullable',
            'file' => 'nullable|image'
        ];
    }
}
