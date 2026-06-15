<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SellerVerificationRequest extends FormRequest
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
            // Personal Info
            'nik' => ['required', 'string', 'max:20', 'regex:/^[0-9]+$/'],
            'full_name' => ['required', 'string', 'max:100'],

            // Business Info
            'business_name' => ['nullable', 'string', 'max:100'],
            'business_type' => ['nullable', Rule::in(['personal', 'company', 'cooperative'])],
            'nib_number' => ['nullable', 'string', 'max:50'],

            // Documents
            'ktp_file' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:5120'],
            'npwp_file' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:5120'],
            'siu_file' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:10240'],
            'selfie_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:5120'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nik.required' => 'Nomor KTP wajib diisi.',
            'nik.regex' => 'Nomor KTP harus berupa angka saja.',
            'nik.max' => 'Nomor KTP maksimal 20 karakter.',
            'full_name.required' => 'Nama lengkap wajib diisi.',
            'full_name.max' => 'Nama lengkap maksimal 100 karakter.',
            'ktp_file.required' => 'Foto KTP wajib diupload.',
            'ktp_file.image' => 'File KTP harus berupa gambar.',
            'ktp_file.mimes' => 'Format KTP harus JPG atau PNG.',
            'ktp_file.max' => 'Ukuran KTP maksimal 5MB.',
            'npwp_file.required' => 'Foto NPWP wajib diupload.',
            'npwp_file.image' => 'File NPWP harus berupa gambar.',
            'npwp_file.mimes' => 'Format NPWP harus JPG atau PNG.',
            'npwp_file.max' => 'Ukuran NPWP maksimal 5MB.',
            'siu_file.max' => 'Ukuran Surat Izin Usaha maksimal 10MB.',
            'selfie_file.image' => 'File selfie harus berupa gambar.',
            'selfie_file.mimes' => 'Format selfie harus JPG atau PNG.',
            'selfie_file.max' => 'Ukuran selfie maksimal 5MB.',
        ];
    }
}
