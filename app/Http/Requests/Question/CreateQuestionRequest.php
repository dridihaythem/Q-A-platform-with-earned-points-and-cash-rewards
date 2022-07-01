<?php

namespace App\Http\Requests\Question;

use App\Rules\minWords;
use App\Services\SettingService;
use Illuminate\Foundation\Http\FormRequest;

class CreateQuestionRequest extends FormRequest
{
    public function __construct(private SettingService $settingService)
    {
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create-question');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'category_id' => 'required|numeric|exists:categories,id',
            'title' => ['required', new minWords($this->settingService->get('MIN_QUESTION_TITLE_WORDS'))],
            'content' => ['required', new minWords($this->settingService->get('MIN_QUESTION_CONTENT_WORDS'))],
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'العنوان',
            'content' => 'الوصف'
        ];
    }
}
