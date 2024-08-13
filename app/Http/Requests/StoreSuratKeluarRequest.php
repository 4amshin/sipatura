<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSuratKeluarRequest extends FormRequest
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
            'nomor_surat' => 'required|string|unique:surat_keluars,nomor_surat|max:255',
            'tanggal_keluar' => 'required|date',
            'isi_ringkasan' => 'required|string',
            'keterangan' => 'nullable|string',
            'lokasi_file' => 'nullable|string|max:255',
            'alamat' => 'required|string',
        ];
    }
}
