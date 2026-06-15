<?php

namespace App\Http\Requests;

use App\Models\Store;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
        $layouts = array_keys(Store::getLayouts());
        $templates = array_keys(Store::getTemplatePresets());
        $fonts = array_keys(Store::getAvailableFonts());
        $storeId = $this->user()?->store?->id ?? $this->route('store');

        return [
            // Basic Info
            'name' => ['required', 'string', 'max:100'],
            'username' => [
                'required',
                'string',
                'min:3',
                'max:50',
                'regex:/^[a-z0-9\-]+$/',
                Rule::unique('stores', 'username')->ignore($storeId),
            ],
            'description' => ['nullable', 'string', 'max:500'],
            'whatsapp' => ['nullable', 'string', 'max:16', 'regex:/^62[0-9]{8,14}$/'],
            'payout_bank_name' => ['nullable', 'string', 'max:255'],
            'payout_account_number' => ['nullable', 'string', 'max:50', 'regex:/^[0-9\s\-]+$/'],
            'payout_account_name' => ['nullable', 'string', 'max:255'],
            'logo' => ['nullable', 'url', 'max:500'],

            // Page Style
            'layout' => ['nullable', Rule::in($layouts)],
            'banner' => ['nullable', 'string', 'max:5000000'],
            'profile_image' => ['nullable', 'string', 'max:5000000'],
            'about_text' => ['nullable', 'string', 'max:1000'],
            'profile_text_color' => ['nullable', 'regex:/^#[0-9A-Fa-f]{6}$/'],

            // Background
            'background_type' => ['nullable', Rule::in(['flat', 'gradient_up', 'gradient_down', 'image'])],
            'background_color' => ['nullable', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'background_gradient_start' => ['nullable', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'background_gradient_end' => ['nullable', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'background_image' => ['nullable', 'url', 'max:500'],

            // Fonts
            'font_family' => ['nullable', 'string', 'max:100', Rule::in($fonts)],
            'heading_font_family' => ['nullable', 'string', 'max:100', Rule::in($fonts)],

            // Button Style
            'button_style' => ['nullable', Rule::in(['box', 'arrow', 'scribble'])],
            'cta_button_style' => ['nullable', Rule::in(['fill', 'outline'])],
            'cta_button_shape' => ['nullable', Rule::in(['sharp', 'rounded', 'pill', 'sharp-hard', 'rounded-hard', 'pill-hard', 'square-soft', 'rounded-soft', 'rainbow', 'bracket', 'scribble'])],
            'cta_button_color' => ['nullable', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'cta_button_text_color' => ['nullable', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'cta_button_shadow' => ['nullable', 'boolean'],

            // Social Links
            'social_telegram' => ['nullable', 'url', 'max:500'],
            'social_website' => ['nullable', 'url', 'max:500'],
            'social_email' => ['nullable', 'email', 'max:200'],
            'social_discord' => ['nullable', 'string', 'max:200'],
            'social_tiktok' => ['nullable', 'string', 'max:200'],
            'social_instagram' => ['nullable', 'string', 'max:200'],
            'social_youtube' => ['nullable', 'url', 'max:500'],
            'social_twitch' => ['nullable', 'url', 'max:500'],
            'social_linkedin' => ['nullable', 'url', 'max:500'],
            'social_x' => ['nullable', 'string', 'max:200'],
            'social_facebook' => ['nullable', 'url', 'max:500'],
            'social_behance' => ['nullable', 'url', 'max:500'],
            'social_dribbble' => ['nullable', 'url', 'max:500'],
            'social_whatsapp' => ['nullable', 'string', 'max:20'],
            'social_spotify' => ['nullable', 'url', 'max:500'],
            'social_threads' => ['nullable', 'string', 'max:200'],

            // Theme
            'theme' => ['nullable', Rule::in($templates)],
            'header_gradient_start' => ['nullable', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'header_gradient_end' => ['nullable', 'regex:/^#[0-9A-Fa-f]{6}$/'],
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
            'username.regex' => 'Username hanya boleh berisi huruf kecil, angka, dan tanda strip (-).',
            'username.unique' => 'Username ini sudah digunakan. Silakan pilih username lain.',
            'username.min' => 'Username minimal 3 karakter.',
            'username.max' => 'Username maksimal 50 karakter.',
            'whatsapp.regex' => 'Nomor WhatsApp harus memakai nomor Indonesia yang valid, contoh: 8123456789 atau 628123456789.',
            'payout_account_number.regex' => 'Nomor rekening hanya boleh berisi angka, spasi, dan tanda strip (-).',
            'profile_text_color.regex' => 'Format warna profil tidak valid. Gunakan format hex (#RRGGBB).',
            'background_color.regex' => 'Format warna background tidak valid.',
            '*.regex' => 'Format warna tidak valid. Gunakan format hex (#RRGGBB).',
            'social_email.email' => 'Format email tidak valid.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Auto-lowercase and trim username
        if ($this->has('username')) {
            $this->merge([
                'username' => strtolower(trim($this->username)),
            ]);
        }

        if ($this->has('whatsapp')) {
            $whatsapp = preg_replace('/\D/', '', (string) $this->whatsapp);

            if ($whatsapp !== '') {
                if (str_starts_with($whatsapp, '0')) {
                    $whatsapp = '62' . ltrim($whatsapp, '0');
                } elseif (!str_starts_with($whatsapp, '62')) {
                    $whatsapp = '62' . $whatsapp;
                }
            }

            $this->merge([
                'whatsapp' => $whatsapp,
            ]);
        }

        // Convert checkbox string values to boolean
        if ($this->has('cta_button_shadow')) {
            $this->merge([
                'cta_button_shadow' => filter_var($this->cta_button_shadow, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) ?? false,
            ]);
        }
    }

    /**
     * Get validated data with PRO restrictions applied.
     * Removes PRO-only fields for non-PRO users.
     */
    public function validatedWithProRestrictions($store): array
    {
        $validated = $this->validated();

        // Remove PRO-only fields for non-PRO users
        if (!$store->isPro()) {
            $proFields = [
                'background_image',
                'heading_font_family',
                'cta_button_style',
                'cta_button_shape',
                'cta_button_color',
                'cta_button_text_color',
                'cta_button_shadow',
                'social_telegram',
                'social_website',
                'social_email',
                'social_discord',
                'social_tiktok',
                'social_instagram',
                'social_youtube',
                'social_twitch',
                'social_linkedin',
                'social_x',
                'social_facebook',
                'social_behance',
                'social_dribbble',
                'social_whatsapp',
                'social_spotify',
                'social_threads',
            ];

            foreach ($proFields as $field) {
                unset($validated[$field]);
            }
        }

        return $validated;
    }
}
