<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DosenRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $dosenId = $this->route('dosen')?->id;
        
        return [
            'nip' => 'required|string|unique:dosen,nip,' . ($dosenId ?: 'NULL') . ',id',
            'nama' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email,' . ($dosenId ?: 'NULL') . ',dosen_id',
            'jabatan' => 'required|string',
            'prodi' => 'required|in:Informatika,Sistem Informasi,Teknik Elektro',
            'is_active' => 'boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'nip.required' => 'NIP wajib diisi',
            'nip.unique' => 'NIP sudah terdaftar',
            'nama.required' => 'Nama wajib diisi',
            'nama.min' => 'Nama minimal 3 karakter',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'jabatan.required' => 'Jabatan wajib diisi',
            'prodi.required' => 'Prodi wajib diisi',
            'prodi.in' => 'Prodi tidak valid',
            'is_active.boolean' => 'Status harus boolean'
        ];
    }
}
