<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSuratMasukRequest extends FormRequest
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
            'nomor_surat' => 'required|string|unique:surat_masuks,nomor_surat',
            'tanggal_surat' => 'required|date',
            'tanggal_masuk' => 'required|date',
            'pengirim' => 'required|string',
            'kepada' => 'required|string',
            'perihal' => 'required|string',
            'file' => 'nullable|file|mimes:pdf|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'file.mimes' => 'File harus berupa format PDF.',
            'file.max' => 'Ukuran file tidak boleh lebih dari 2MB.',
        ];
    }
}
