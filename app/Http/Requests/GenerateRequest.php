<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class GenerateRequest extends FormRequest
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

    protected function prepareForValidation(): void
    {
        $this->merge([
            'your_email'   => strip_tags(Str::lower($this->your_email)),
            'email_from'   => strip_tags(Str::lower($this->email_from)),
            'inc_keywords' => strip_tags($this->inc_keywords),
            'exc_keywords' => strip_tags($this->exc_keywords),
            'language'     => strip_tags(Str::lower($this->language))
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'your_email'   => 'required|email|max:255',
            'email_from'   => 'required|email|max:255',
            'inc_keywords' => 'nullable|string|max:255',
            'exc_keywords' => 'nullable|string|max:255',
            'start_date'   => 'nullable|date|date_format:Y-m-d',
            'end_date'     => 'nullable|date|date_format:Y-m-d|after_or_equal:start_date',
            'language'     => 'nullable|in:en,he',
            'search_attachments_list'     => 'nullable|in:0,1,2',
            'search_keyword_list'     => 'nullable|in:0,1'
        ];
    }

    public function messages()
    {
        return [
            'end_date.after_or_equal' => 'The end date must be a date after or equal to the start date.',
        ];
    }
}
