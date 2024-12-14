<?php

namespace App\Http\Requests\Admin\Series;

use Illuminate\Foundation\Http\FormRequest;

class AdminSeriesStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "user_id"            => "required|exists:users,id",
            "distrack_model_id"  => "required|exists:distrack_models,id",
            "quantity"           => "required|gt:0",
        ];
    }

    public function getData()
    {
        $data             = $this->validated();
        $data["model_id"] = $data["distrack_model_id"];
        unset($data["distrack_model_id"]);


        return $data;
    }
}
