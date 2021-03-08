<?php

namespace App\Http\Requests;

use App\Actions\Fortify\PasswordValidationRules;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    use PasswordValidationRules;

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
     * @return array
     */
    public function rules()
    {
        $userId = optional($this->route('user'))->id;

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $userId . ',id'],
            'password' => $this->passwordRules(),
            'role' => ['required', 'string', 'in:USER,ADMIN'],
            'address' => ['required', 'string', 'max:500'],
            'city' => ['required', 'string', 'max:50'],
            'country' => ['required', 'string', 'max:50'],
            'phone_number' => ['required', 'string', 'max:50'],
        ];
    }
}
