<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\AppearanceRequest;
use App\Models\Store;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class AppearanceController extends Controller
{
    /**
     * Display the appearance settings page.
     */
    public function index(Request $request): View
    {
        $store = $request->user()->store;
        $layouts = Store::getLayouts();
        $fonts = Store::getAvailableFonts();
        $templatePresets = Store::getTemplatePresets();
        $allTemplates = Store::getAllTemplateKeys();

        return view('seller.appearance.index', compact(
            'store',
            'layouts',
            'fonts',
            'templatePresets',
            'allTemplates'
        ));
    }

    /**
     * Update the appearance settings.
     */
    public function update(AppearanceRequest $request): RedirectResponse
    {
        $store = $request->user()->store;

        if (!$store) {
            return redirect()
                ->route('seller.dashboard')
                ->with('error', 'Store tidak ditemukan!');
        }

        // Log request data for debugging
        \Log::info('Appearance Update Request', [
            'has_banner_file' => $request->hasFile('banner_file'),
            'has_profile_file' => $request->hasFile('profile_file'),
            'has_background_file' => $request->hasFile('background_file'),
            'banner_remove' => $request->input('banner_remove'),
            'profile_remove' => $request->input('profile_remove'),
            'background_remove' => $request->input('background_remove'),
            'all_files' => $request->allFiles(),
        ]);

        // Handle file uploads
        $validated = $request->validatedWithProRestrictions($store);

        // Handle banner upload
        if ($request->hasFile('banner_file')) {
            $bannerPath = $request->file('banner_file')->store('banners', 'public');
            $validated['banner'] = Storage::url($bannerPath);
        }

        // Handle banner removal
        if ($request->input('banner_remove') === '1') {
            $validated['banner'] = null;
        }

        // Handle profile image upload
        if ($request->hasFile('profile_file')) {
            $profilePath = $request->file('profile_file')->store('profiles', 'public');
            $validated['profile_image'] = Storage::url($profilePath);
        }

        // Handle background image upload
        if ($request->hasFile('background_file')) {
            $backgroundPath = $request->file('background_file')->store('backgrounds', 'public');
            $validated['background_image'] = Storage::url($backgroundPath);
            $validated['background_type'] = 'image';
        }

        // Handle background image removal
        if ($request->input('background_remove') === '1') {
            $validated['background_image'] = null;
            if (($validated['background_type'] ?? null) === 'image') {
                $validated['background_type'] = 'flat';
            }
        }

        // Handle profile image removal
        if ($request->input('profile_remove') === '1') {
            $validated['profile_image'] = null;
        }

        if (array_key_exists('template', $validated) && blank($validated['template'])) {
            $validated['template'] = null;
            $validated['theme'] = 'minimal';
        }

        unset($validated['banner_remove'], $validated['profile_remove'], $validated['background_remove']);

        // Log what we're about to update
        \Log::info('Appearance Update Data', $validated);

        $store->update($validated);

        return redirect()
            ->route('seller.appearance.index')
            ->with('success', 'Pengaturan tampilan berhasil disimpan!');
    }

    /**
     * Preview the store with custom appearance.
     */
    public function preview(Request $request): View
    {
        $store = $request->user()->store;

        if (!$store) {
            abort(404);
        }

        return view('seller.appearance.preview', compact('store'));
    }

    /**
     * Save appearance preview to session (without persisting).
     */
    public function previewSave(Request $request): \Illuminate\Http\JsonResponse
    {
        $store = $request->user()->store;

        if (!$store) {
            return response()->json(['success' => false, 'error' => 'Store not found'], 404);
        }

        $banner = $request->input('banner');
        if ($request->input('banner_remove') === '1') {
            $banner = null;
        }

        $profileImage = $request->input('profile_image');
        if ($request->input('profile_remove') === '1') {
            $profileImage = null;
        }

        // Store preview data in session
        $previewData = [
            'background_color' => $request->input('background_color'),
            'background_type' => $request->input('background_type'),
            'background_gradient_start' => $request->input('background_gradient_start'),
            'background_gradient_end' => $request->input('background_gradient_end'),
            'background_image' => $request->input('background_remove') === '1' ? null : $request->input('background_image'),
            'header_gradient_start' => $request->input('header_gradient_start'),
            'header_gradient_end' => $request->input('header_gradient_end'),
            'theme' => $request->input('theme'),
            'template' => $request->input('template'),
            'layout' => $request->input('layout'),
            'banner' => $banner,
            'profile_image' => $profileImage,
            'about_text' => $request->input('about_text'),
            'cta_button_color' => $request->input('cta_button_color'),
            'cta_button_text_color' => $request->input('cta_button_text_color'),
            'cta_button_shape' => $request->input('cta_button_shape'),
            'cta_button_style' => $request->input('cta_button_style'),
            'cta_button_shadow' => $request->boolean('cta_button_shadow'),
            'profile_text_color' => $request->input('profile_text_color'),
            'font_family' => $request->input('font_family'),
            'heading_font_family' => $request->input('heading_font_family'),
            'button_style' => $request->input('button_style'),
            'social_telegram' => $request->input('social_telegram'),
            'social_website' => $request->input('social_website'),
            'social_email' => $request->input('social_email'),
            'social_discord' => $request->input('social_discord'),
            'social_tiktok' => $request->input('social_tiktok'),
            'social_instagram' => $request->input('social_instagram'),
            'social_youtube' => $request->input('social_youtube'),
            'social_twitch' => $request->input('social_twitch'),
            'social_linkedin' => $request->input('social_linkedin'),
            'social_x' => $request->input('social_x'),
            'social_facebook' => $request->input('social_facebook'),
            'social_behance' => $request->input('social_behance'),
            'social_dribbble' => $request->input('social_dribbble'),
            'social_whatsapp' => $request->input('social_whatsapp'),
            'social_spotify' => $request->input('social_spotify'),
            'social_threads' => $request->input('social_threads'),
        ];

        // Store with store ID key for multi-store support
        $request->session()->put('preview_store_' . $store->id, $previewData);

        return response()->json(['success' => true]);
    }

    /**
     * Clear preview session.
     */
    public function previewClear(Request $request): \Illuminate\Http\JsonResponse
    {
        $store = $request->user()->store;

        if ($store) {
            $request->session()->forget('preview_store_' . $store->id);
        }

        return response()->json(['success' => true]);
    }
}
