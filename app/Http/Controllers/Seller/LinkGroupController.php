<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\LinkGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class LinkGroupController extends Controller
{
    /**
     * Display a listing of link groups.
     */
    public function index()
    {
        $store = auth()->user()->store;

        if (!$store) {
            return redirect()->route('seller.onboarding');
        }

        $groups = LinkGroup::where('store_id', $store->id)
            ->withCount('links')
            ->orderBy('sort_order')
            ->get();

        return view('seller.links.groups.index', [
            'store' => $store,
            'groups' => $groups,
        ]);
    }

    /**
     * Store a newly created link group.
     */
    public function store(Request $request)
    {
        $store = auth()->user()->store;

        if (!$store) {
            return redirect()->route('seller.onboarding');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'icon' => 'nullable|string|max:10',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $maxSortOrder = LinkGroup::where('store_id', $store->id)->max('sort_order') ?? 0;

        LinkGroup::create([
            'store_id' => $store->id,
            'name' => $request->name,
            'icon' => $request->icon,
            'sort_order' => $maxSortOrder + 1,
            'is_active' => true,
        ]);

        return redirect()->back()
            ->with('success', "Group '{$request->name}' berhasil dibuat!");
    }

    /**
     * Update the specified link group.
     */
    public function update(Request $request, LinkGroup $linkGroup)
    {
        // Ensure the group belongs to the current user's store
        if ($linkGroup->store_id !== auth()->user()->store->id) {
            abort(403);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'icon' => 'nullable|string|max:10',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $linkGroup->update([
            'name' => $request->name,
            'icon' => $request->icon,
        ]);

        return redirect()->back()
            ->with('success', "Group berhasil diperbarui!");
    }

    /**
     * Remove the specified link group.
     */
    public function destroy(LinkGroup $linkGroup)
    {
        if ($linkGroup->store_id !== auth()->user()->store->id) {
            abort(403);
        }

        $name = $linkGroup->name;
        $linkGroup->delete();

        return redirect()->back()
            ->with('success', "Group '{$name}' berhasil dihapus!");
    }

    /**
     * Toggle the active status of a link group.
     */
    public function toggleActive(LinkGroup $linkGroup)
    {
        if ($linkGroup->store_id !== auth()->user()->store->id) {
            abort(403);
        }

        $linkGroup->update([
            'is_active' => !$linkGroup->is_active,
        ]);

        $status = $linkGroup->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->back()
            ->with('success', "Group berhasil {$status}!");
    }

    /**
     * Reorder link groups via drag and drop.
     */
    public function reorder(Request $request)
    {
        $store = auth()->user()->store;

        if (!$store) {
            return response()->json(['success' => false, 'message' => 'Store not found']);
        }

        $request->validate([
            'order' => 'required|array',
            'order.*' => 'integer',
        ]);

        foreach ($request->order as $index => $groupId) {
            LinkGroup::where('id', $groupId)
                ->where('store_id', $store->id)
                ->update(['sort_order' => $index]);
        }

        return response()->json(['success' => true]);
    }
}
