<?php

namespace App\Http\Requests\Admin;

use App\Models\User;
use App\Utils\AppStatic;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
            'first_name'          => 'required|string',
            'middle_name'          => 'string',
            'last_name'          => 'string',
            'username'          => ["required", Rule::unique("users")->ignore($this->user->id)],
            'email'          => 'email|string',
            'password'          => 'required|string',
            "photo"               => "nullable|image|".imageMimes(),
        ];
    }

    public function getData()
    {
        $data              = $this->validated();
        $data["user_type"] = AppStatic::TYPE_ADMIN_STAFF;
        $data["parent_user_id"] = userId();
        $data["is_active"] = setIsActive();
        return $data;
    }
}
