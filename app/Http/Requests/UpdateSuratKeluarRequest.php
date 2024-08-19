<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSuratKeluarRequest extends FormRequest
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
        // dd($this->route('suratKeluar'));
        // dd($this->route('id'));
        return [
            'nomor_surat' => [
                'required',
                'string',
                Rule::unique('surat_keluars', 'nomor_surat')->ignore($this->route('suratKeluar'))
            ],
            // 'nomor_surat' => 'required|string',
            'tanggal_surat' => 'required|date',
            'tanggal_keluar' => 'required|date',
            'kepada' => 'required|string',
            'perihal' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ];
    }
}
