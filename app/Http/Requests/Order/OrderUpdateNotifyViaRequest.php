<?php

namespace App\Http\Requests\Order;

use App\Traits\Api\ApiResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class OrderUpdateNotifyViaRequest extends FormRequest
{
    use ApiResponseTrait;
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
            "notify_channel" => "required|in:sms,email",
            "notify_value"   => "required",
        ];
    }

    public function messages(){
        return [
            "notify_channel.required" => "Please, select SMS/Email to notify you.",
            "notify_value.required"   => "Please, put your phone number or Email to notify you.",
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            $this->sendResponse(
                appStatic()::VALIDATON_ERROR,
                "Failed Notify via validation",
                [],
                $validator->errors()
            )
        );
    }
}
