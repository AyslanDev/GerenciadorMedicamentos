<?php

namespace App\Http\Requests\Medicamentos;

use Illuminate\Foundation\Http\FormRequest;

class MedicamentoRequest extends FormRequest
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
            'nome' => ['required', 'string'],
            'quantidade' => ['required', 'integer', 'min:1'],
            'validade' => ['required', 'date_format:d/m/Y', 'after:today']
        ];
    }

}
