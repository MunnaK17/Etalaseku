<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SocialMediaTemplate;
use Illuminate\Http\JsonResponse;

class SocialMediaTemplateController extends Controller
{
    /**
     * Get all templates grouped by category.
     */
    public function index(): JsonResponse
    {
        $templates = SocialMediaTemplate::where('is_active', true)
            ->orderBy('category')
            ->orderBy('sort_order')
            ->get()
            ->groupBy('category');

        return response()->json([
            'success' => true,
            'data' => $templates,
        ]);
    }

    /**
     * Get templates by category.
     */
    public function byCategory(string $category): JsonResponse
    {
        $templates = SocialMediaTemplate::where('category', $category)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $templates,
        ]);
    }

    /**
     * Get single template.
     */
    public function show(string $slug): JsonResponse
    {
        $template = SocialMediaTemplate::where('slug', $slug)
            ->where('is_active', true)
            ->first();

        if (!$template) {
            return response()->json([
                'success' => false,
                'message' => 'Template not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $template,
        ]);
    }
}
