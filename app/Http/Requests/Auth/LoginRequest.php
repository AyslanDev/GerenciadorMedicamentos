<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class LoginRequest extends FormRequest
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
            'username' => ['required', 'string'],
            'password' => ['required']
        ];
    }

    public function attemp(): bool
    {

        
        if($user = User::query()->where(

            'name', '=', $this->username

        )->first()
        ){

            if(Hash::check($this->password, $user->password)){

                auth()->login($user);

                return true;
            }

        }

        return false;

    }
}
