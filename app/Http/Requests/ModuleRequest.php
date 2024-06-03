<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModuleRequest extends FormRequest
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
            'nama_module' => 'required|string|max:255',
            'tipe' => 'required|string|max:255',
            'waktu_mengerjakan' => 'required|integer',
            'soal' => 'required|string',
            'link' => 'required|string',
        ];
    }
}
