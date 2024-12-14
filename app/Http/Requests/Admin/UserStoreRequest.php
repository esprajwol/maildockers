<?php

namespace App\Http\Requests\Admin;

use App\Models\Distributor;
use App\Models\User;
use App\Services\Models\User\DistributorService;
use App\Utils\AppStatic;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'username'          => 'required|string|unique:users',
            'email'          => 'email|string',
            'password'          => 'required|string',
         /*   'user_type'          => 'required|string',
            'parent_user_id'          => 'integer|gt:0',
            'package_id'          => 'integer|gt:0',
            'menu_permission_version'          => 'required|integer',*/
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
