<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UserPasswordResetRequest extends FormRequest
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
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ];
    }
    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!$this->checkCurrentPassword()) {
                $validator->errors()->add('current_password', 'Current password is incorrect.');
            }
        });
    }

    /**
     * Check if the current password matches the user's password.
     *
     * @return bool
     */
    protected function checkCurrentPassword()
    {
        return Hash::check($this->input('current_password'), user()->password);
    }

    /**
     * Get the validated data and hash the new password.
     *
     * @return array
     */
    public function getData()
    {
        $data = $this->validated();
        $data['password'] = Hash::make($data['new_password']);
        unset($data['new_password'], $data['new_password_confirmation'], $data['current_password']);
        return $data;
    }
  /*  public function getData()
    {
        $data              = $this->validated();
        $data['password'] = Hash::make($data['new_password']);
        unset($data['new_password']);
        return $data;
    }*/
}
