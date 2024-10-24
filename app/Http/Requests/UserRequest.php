<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name'                => 'required|string|min:3|max:100',
            'email'               => 'required|string|min:3|max:100|unique:users,email,' . optional($this->user)->id,
            'password'            => 'string|min:3|max:100|' . (optional($this->user)->id ? 'nullable' : 'required'),
            'password'            => 'string|min:3|max:100|confirmed|'. (optional($this->user)->id ? 'nullable' : 'required'),
            'old_password'        => $this->password && optional($this->user)->id ? 'required|string|min:3|max:100' : 'nullable|string|min:3|max:100',
            'profile_photo_path'  => 'dimensions:width=300,height=300',
        ];
    }
}
