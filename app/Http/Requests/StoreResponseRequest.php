<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreResponseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'isi' => ['required', 'string', 'min:10'],
            'status' => ['required', 'in:pending,diproses,menunggu_persetujuan_atasan,diterima,ditolak'],
            'prioritas' => ['nullable', 'in:rendah,sedang,tinggi'],
            'is_internal' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'isi.required' => 'Isi tanggapan wajib diisi.',
            'isi.min' => 'Isi tanggapan minimal 10 karakter.',
            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status tidak valid.',
        ];
    }
}
