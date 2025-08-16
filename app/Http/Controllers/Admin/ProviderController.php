<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Provider::query();

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%");
        }

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('is_active', $request->status);
        }

        $providers = $query->orderBy('sort_order')->orderBy('name')->paginate(12);

        return view('admin.providers.index', compact('providers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.providers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer'
        ]);

        $validated['slug'] = Str::slug($validated['name'] . '-' . time());

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoName = time() . '_provider_logo_' . $logo->getClientOriginalName();
            $logoPath = $logo->storeAs('providers/logos', $logoName, 'public');
            $validated['logo_url'] = Storage::url($logoPath);
        }

        Provider::create($validated);

        return redirect()->route('admin.providers.index')
            ->with('success', 'Provider berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Provider $provider)
    {
        $provider->load('games');
        return view('admin.providers.show', compact('provider'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Provider $provider)
    {
        return view('admin.providers.edit', compact('provider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Provider $provider)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer'
        ]);

        if ($validated['name'] !== $provider->name) {
            $validated['slug'] = Str::slug($validated['name'] . '-' . time());
        }

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($provider->logo_url && !str_contains($provider->logo_url, 'placeholder')) {
                $oldLogoPath = str_replace('/storage/', '', $provider->logo_url);
                Storage::disk('public')->delete($oldLogoPath);
            }

            $logo = $request->file('logo');
            $logoName = time() . '_provider_logo_' . $logo->getClientOriginalName();
            $logoPath = $logo->storeAs('providers/logos', $logoName, 'public');
            $validated['logo_url'] = Storage::url($logoPath);
        }

        $provider->update($validated);

        return redirect()->route('admin.providers.index')
            ->with('success', 'Provider berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Provider $provider)
    {
        // Check if provider has games
        if ($provider->games()->count() > 0) {
            return redirect()->route('admin.providers.index')
                ->with('error', 'Tidak dapat menghapus provider yang masih memiliki games!');
        }

        // Delete logo if it exists
        if ($provider->logo_url && !str_contains($provider->logo_url, 'placeholder')) {
            $logoPath = str_replace('/storage/', '', $provider->logo_url);
            Storage::disk('public')->delete($logoPath);
        }

        $provider->delete();

        return redirect()->route('admin.providers.index')
            ->with('success', 'Provider berhasil dihapus!');
    }

    /**
     * Toggle provider status
     */
    public function toggleStatus(Provider $provider)
    {
        $provider->update(['is_active' => !$provider->is_active]);
        
        $status = $provider->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return response()->json([
            'success' => true,
            'message' => "Provider berhasil {$status}!",
            'status' => $provider->is_active
        ]);
    }
}
