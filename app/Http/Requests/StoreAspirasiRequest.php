<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAspirasiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'judul' => ['required', 'string', 'max:255'],
            'isi' => ['required', 'string', 'min:20'],
            'kategori_id' => ['required', 'exists:kategori,id'],
            'is_anonim' => ['nullable', 'boolean'],
            'lampiran.*' => ['nullable', 'file', 'max:10240', 'mimes:pdf,jpg,jpeg,png,doc,docx'],
        ];
    }

    public function messages(): array
    {
        return [
            'judul.required' => 'Judul aspirasi wajib diisi.',
            'judul.max' => 'Judul maksimal 255 karakter.',
            'isi.required' => 'Isi aspirasi wajib diisi.',
            'isi.min' => 'Isi aspirasi minimal 20 karakter.',
            'kategori_id.required' => 'Kategori wajib dipilih.',
            'kategori_id.exists' => 'Kategori tidak valid.',
            'lampiran.*.max' => 'Ukuran file maksimal 10MB.',
            'lampiran.*.mimes' => 'Format file harus PDF, JPG, PNG, DOC, atau DOCX.',
        ];
    }
}
