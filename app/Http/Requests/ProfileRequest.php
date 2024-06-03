<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'token' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string',
            'jabatan' => 'required|string',
            'perusahaan' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jadwal' => 'required|integer',
        ];
    }
}
