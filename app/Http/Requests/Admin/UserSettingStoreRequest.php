<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserSettingStoreRequest extends FormRequest
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
            'is_enable_two_factor_authentication' => 'sometimes|boolean',
            'is_enable_notification' => 'sometimes|boolean',
            'is_enable_sms' => 'sometimes|boolean',
        ];
    }
    /**
     * Get the validated data and hash the new password.
     *
     * @return array
     */
    public function getData()
    {
        $data = $this->validated();
        $data["is_enable_notification"]              = request()->has("is_enable_notification") ? 1 : 0;
        $data["is_enable_two_factor_authentication"] = request()->has("is_enable_two_factor_authentication") ? 1 : 0;
        $data['user_id'] = userId();
        return $data;
    }
}
