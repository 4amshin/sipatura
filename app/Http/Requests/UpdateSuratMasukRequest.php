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
            'tanggal_surat' => 'required|date',
            'tanggal_masuk' => 'required|date',
            'pengirim' => 'required|string',
            'perihal' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ];
    }
}
