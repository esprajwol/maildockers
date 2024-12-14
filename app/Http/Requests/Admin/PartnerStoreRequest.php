<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PartnerStoreRequest extends FormRequest
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
            "first_name"   => "required",
            "middle_name"   => "nullable",
            "last_name"   => "nullable",

            // Authentication
            "username"   => "required|unique:users",
            "password"   => "required|min:6",
            "email"   => "required|email",

            // Company
            "company_name"   => "nullable",
            "office_address"   => "nullable",
            "company_description"   => "nullable",

            // Account
            "account_name"   => "nullable",
            "account_iban"   => "nullable",
            "account_swift"   => "nullable",
            "vat_number"   => "nullable",

            // Contact
            "contact_full_name"   => "nullable",
            "contact_title"   => "nullable",
            "contact_email"   => "nullable",
            "contact_mobile_number"   => "nullable",

            // Social
            "facebook_link" => "nullable",
            "instagram_link" => "nullable",
            "tiktok_link" => "nullable",
            "youtube_link" => "nullable",

            // Attachemnts
            "company_logo" => "nullable|image|".imageMimes(),
            "photo" => "nullable|image|".imageMimes(),
            
            "country_id"   => [
                "required",
                    Rule::unique('users', 'country_id')->where(function ($query) {
                        $query->where('user_type', "partner");
                    }),
            ],
            
            "sub_domain_prefix"   => "required",
            "state_id" => 'nullable|exists:states,id', // Allow null or a valid state ID

        ];
    }

    public function messages()
    {
        return [
            'country_id.unique' => 'A partner has already been created for this country.',
        ];
    }

    public function getData()
    {
        $data              = $this->validated();
        $data["is_active"] = 1;
        // $data["is_active"] = setIsActive();
        $data["user_type"] = appStatic()::TYPE_PARTNER;
        $data["affiliation_id"] = request()->affiliation_id ?? randomStringNumberGenerator(6,true,true);
        $data["password"] = bcrypt($data["password"]);
        return $data;
    }
}
