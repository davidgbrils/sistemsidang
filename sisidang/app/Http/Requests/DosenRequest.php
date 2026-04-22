<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DosenRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $dosenId = $this->route('dosen') ? $this->route('dosen')->id : null;

        return [
            'nip' => [
                'required',
                'string',
                'max:20',
                Rule::unique('dosen', 'nip')->ignore($dosenId),
            ],
            'nama' => 'required|string|min:3|max:100',
            'email' => [
                'required',
                'email',
                Rule::unique('dosen', 'email')->ignore($dosenId),
            ],
            'jabatan' => 'required|string|max:50',
            'prodi' => 'required|in:Informatika,Sistem Informasi,Teknik Elektro',
            'is_active' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'nip.required' => 'NIP wajib diisi.',
            'nip.unique' => 'NIP sudah terdaftar dalam sistem.',
            'nama.required' => 'Nama lengkap wajib diisi.',
            'nama.min' => 'Nama minimal terdiri dari 3 karakter.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan oleh dosen lain.',
            'jabatan.required' => 'Jabatan akademik wajib diisi.',
            'prodi.required' => 'Program studi wajib dipilih.',
            'prodi.in' => 'Program studi yang dipilih tidak valid.',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'is_active' => $this->has('is_active'),
        ]);
    }
}
