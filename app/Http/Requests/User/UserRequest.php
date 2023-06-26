<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public $password = [];
    public $confirmPassword = [];
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        // dd($this->method());
        if($this->method() == 'POST'){
            $this->password = ['required'];
            $this->confirmPassword = ['required'];
        }else{
            $this->password = [];
            $this->confirmPassword = [];
        }
        return [
            'name' => ['required'],
            'email' => ['email','required'],
            'username' => ['required'],
            'password' => $this->password,
            'confirmPassword' => $this->confirmPassword,
            'role' => ['required'],
        ];
    }
}
