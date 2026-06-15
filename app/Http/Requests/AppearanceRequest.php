<?php

namespace App\Http\Requests;

use App\Models\Store;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * AppearanceRequest extends StoreRequest for handling appearance customization validation.
 * Since appearance settings share the same fields as store settings,
 * we inherit all validation rules from StoreRequest.
 */
class AppearanceRequest extends StoreRequest
{
    /**
     * Free user allowed templates (first 4)
     */
    protected array $freeTemplates = ['feeling_lucky', 'minimal', 'city_vibes', 'splash_wave'];

    /**
     * Free user allowed layouts
     */
    protected array $freeLayouts = ['classic', 'modern'];

    /**
     * Free user allowed background types
     */
    protected array $freeBackgroundTypes = ['flat'];

    /**
     * Free user allowed button shapes
     */
    protected array $freeButtonShapes = ['sharp', 'rounded', 'pill'];

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $store = $this->user()?->store;
        $isPro = $store?->isPro() ?? false;

        // Get available templates based on subscription
        $availableTemplates = $isPro
            ? array_keys(Store::getTemplatePresets())
            : $this->freeTemplates;

        // Get available layouts based on subscription
        $availableLayouts = $isPro
            ? array_keys(Store::getLayouts())
            : $this->freeLayouts;

        // Get available background types based on subscription
        $availableBackgroundTypes = $isPro
            ? ['flat', 'gradient_up', 'gradient_down', 'image']
            : $this->freeBackgroundTypes;

        // Get available button shapes based on subscription
        $availableButtonShapes = $isPro
            ? ['sharp', 'rounded', 'pill', 'sharp-hard', 'rounded-hard', 'pill-hard', 'square-soft', 'rounded-soft', 'rainbow', 'bracket', 'scribble']
            : $this->freeButtonShapes;

        $fonts = array_keys(Store::getAvailableFonts());

        return [
            // File uploads
            'banner_file' => ['nullable', 'image', 'max:5120'], // max 5MB
            'profile_file' => ['nullable', 'image', 'max:2048'], // max 2MB
            'background_file' => ['nullable', 'image', 'max:5120'], // max 5MB

            // URL-based (fallback)
            'banner' => ['nullable', 'string', 'max:5000000'],
            'profile_image' => ['nullable', 'string', 'max:5000000'],

            // Page Style - restricted by subscription
            'layout' => ['nullable', Rule::in($availableLayouts)],
            'about_text' => ['nullable', 'string', 'max:1000'],
            'profile_text_color' => ['nullable', 'regex:/^#[0-9A-Fa-f]{6}$/'],

            // Banner & Profile
            'banner_remove' => ['nullable', 'in:0,1'],
            'profile_remove' => ['nullable', 'in:0,1'],

            // Background - restricted by subscription
            'background_type' => ['nullable', Rule::in($availableBackgroundTypes)],
            'background_color' => ['nullable', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'background_gradient_start' => ['nullable', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'background_gradient_end' => ['nullable', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'background_image' => ['nullable', 'string', 'max:5000000'],
            'background_remove' => ['nullable', 'in:0,1'],

            // Fonts
            'font_family' => ['nullable', 'string', 'max:100', Rule::in($fonts)],
            'heading_font_family' => ['nullable', 'string', 'max:100', Rule::in($fonts)],

            // Button Style - restricted by subscription
            'button_style' => ['nullable', Rule::in(['box', 'arrow', 'scribble'])],
            'cta_button_style' => ['nullable', Rule::in(['fill', 'outline'])],
            'cta_button_shape' => ['nullable', Rule::in($availableButtonShapes)],
            'cta_button_color' => ['nullable', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'cta_button_text_color' => ['nullable', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'cta_button_shadow' => ['nullable', 'boolean'],

            // Social Links
            'social_telegram' => ['nullable', 'string', 'max:500'],
            'social_website' => ['nullable', 'string', 'max:500'],
            'social_email' => ['nullable', 'email', 'max:200'],
            'social_discord' => ['nullable', 'string', 'max:200'],
            'social_tiktok' => ['nullable', 'string', 'max:200'],
            'social_instagram' => ['nullable', 'string', 'max:200'],
            'social_youtube' => ['nullable', 'string', 'max:500'],
            'social_twitch' => ['nullable', 'string', 'max:500'],
            'social_linkedin' => ['nullable', 'string', 'max:500'],
            'social_x' => ['nullable', 'string', 'max:200'],
            'social_facebook' => ['nullable', 'string', 'max:500'],
            'social_behance' => ['nullable', 'string', 'max:500'],
            'social_dribbble' => ['nullable', 'string', 'max:500'],
            'social_whatsapp' => ['nullable', 'string', 'max:20'],
            'social_spotify' => ['nullable', 'string', 'max:500'],
            'social_threads' => ['nullable', 'string', 'max:200'],

            // Theme - restricted by subscription
            'theme' => ['nullable', Rule::in($availableTemplates)],
            'template' => ['nullable', Rule::in($availableTemplates)],
            'header_gradient_start' => ['nullable', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'header_gradient_end' => ['nullable', 'regex:/^#[0-9A-Fa-f]{6}$/'],
        ];
    }

    /**
     * Get validated data with PRO restrictions applied.
     * For appearance, we only include appearance-specific fields.
     */
    public function validatedWithProRestrictions($store): array
    {
        $validated = $this->validated();

        // Remove file inputs from validated data (handled separately in controller)
        unset($validated['banner_file'], $validated['profile_file'], $validated['background_file']);

        // Only keep appearance-related fields
        $appearanceFields = [
            // Page Style
            'layout',
            'banner',
            'banner_remove',
            'profile_image',
            'profile_remove',
            'about_text',
            'profile_text_color',

            // Background
            'background_type',
            'background_color',
            'background_gradient_start',
            'background_gradient_end',
            'background_image',
            'background_remove',

            // Fonts
            'font_family',
            'heading_font_family',

            // Button Style
            'button_style',
            'cta_button_style',
            'cta_button_shape',
            'cta_button_color',
            'cta_button_text_color',
            'cta_button_shadow',

            // Social Links
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

            // Theme
            'theme',
            'template',
            'header_gradient_start',
            'header_gradient_end',
        ];

        // Additional server-side enforcement for free users
        if ($store && !$store->isPro()) {
            // Template restrictions
            if (isset($validated['template']) && !in_array($validated['template'], $this->freeTemplates)) {
                unset($validated['template']);
            }

            // Layout restrictions
            if (isset($validated['layout']) && !in_array($validated['layout'], $this->freeLayouts)) {
                unset($validated['layout']);
            }

            // Background type restrictions
            if (isset($validated['background_type']) && !in_array($validated['background_type'], $this->freeBackgroundTypes)) {
                unset($validated['background_type']);
                // Reset to flat if was trying to use pro background
                $validated['background_type'] = 'flat';
                // Also clear background image
                $validated['background_image'] = null;
            }

            // Button shape restrictions
            if (isset($validated['cta_button_shape']) && !in_array($validated['cta_button_shape'], $this->freeButtonShapes)) {
                // Reset to default rounded if was trying to use pro shape
                $validated['cta_button_shape'] = 'rounded';
            }
        }

        return array_intersect_key($validated, array_flip($appearanceFields));
    }
}
