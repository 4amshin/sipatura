<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSuratMasukRequest extends FormRequest
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
            'nomor_surat' => [
                'required',
                'string',
                'max:255',
                Rule::unique('surat_masuks', 'nomor_surat')->ignore($this->route('suratMasuk'))
            ],
            // 'nomor_surat' => 'required|string|max:255|unique:surat_masuks,nomor_surat,' . $this->route('suratMasuk'),
            'tanggal_masuk' => 'required|date',
            'isi_ringkasan' => 'required|string',
            'keterangan' => 'nullable|string',
            'lokasi_file' => 'nullable|string|max:255',
            'alamat' => 'required|string',
        ];
    }
}
