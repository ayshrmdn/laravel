<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Provider;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Game::with(['provider', 'category']);

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhereHas('provider', function($pq) use ($search) {
                      $pq->where('name', 'like', "%{$search}%");
                  })
                  ->orWhereHas('category', function($cq) use ($search) {
                      $cq->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Filter by provider
        if ($request->has('provider') && $request->provider) {
            $query->where('provider_id', $request->provider);
        }

        // Filter by category
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('is_active', $request->status);
        }

        $games = $query->orderBy('sort_order')->orderBy('name')->paginate(25);
        $providers = Provider::where('is_active', true)->orderBy('name')->get();
        $categories = Category::where('is_active', true)->orderBy('name')->get();

        return view('admin.games.index', compact('games', 'providers', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $providers = Provider::where('is_active', true)->orderBy('name')->get();
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        
        return view('admin.games.create', compact('providers', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image_url' => 'required|url',
            'provider_id' => 'required|exists:providers,id',
            'category_id' => 'required|exists:categories,id',
            'is_popular' => 'boolean',
            'is_new' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer',
            'game_url' => 'nullable|url'
        ]);

        $validated['slug'] = Str::slug($validated['name'] . '-' . time());

        Game::create($validated);

        return redirect()->route('admin.games.index')
            ->with('success', 'Game berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Game $game)
    {
        $game->load(['provider', 'category']);
        return view('admin.games.show', compact('game'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Game $game)
    {
        $providers = Provider::where('is_active', true)->orderBy('name')->get();
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        
        return view('admin.games.edit', compact('game', 'providers', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Game $game)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image_url' => 'required|url',
            'provider_id' => 'required|exists:providers,id',
            'category_id' => 'required|exists:categories,id',
            'is_popular' => 'boolean',
            'is_new' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer',
            'game_url' => 'nullable|url'
        ]);

        if ($validated['name'] !== $game->name) {
            $validated['slug'] = Str::slug($validated['name'] . '-' . time());
        }

        $game->update($validated);

        return redirect()->route('admin.games.index')
            ->with('success', 'Game berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        $game->delete();

        return redirect()->route('admin.games.index')
            ->with('success', 'Game berhasil dihapus!');
    }

    /**
     * Toggle game status
     */
    public function toggleStatus(Game $game)
    {
        $game->update(['is_active' => !$game->is_active]);
        
        $status = $game->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return response()->json([
            'success' => true,
            'message' => "Game berhasil {$status}!",
            'status' => $game->is_active
        ]);
    }

    /**
     * Toggle game popular status
     */
    public function togglePopular(Game $game)
    {
        Log::info('Toggle Popular called for game: ' . $game->id);
        
        $oldStatus = $game->is_popular;
        $game->update(['is_popular' => !$game->is_popular]);
        
        Log::info('Game ' . $game->id . ' popular status changed from ' . ($oldStatus ? 'true' : 'false') . ' to ' . ($game->is_popular ? 'true' : 'false'));
        
        $status = $game->is_popular ? 'ditandai sebagai populer' : 'dihapus dari populer';
        return response()->json([
            'success' => true,
            'message' => "Game {$game->name} berhasil {$status}!",
            'status' => $game->is_popular
        ]);
    }

    /**
     * Toggle game new status
     */
    public function toggleNew(Game $game)
    {
        $game->update(['is_new' => !$game->is_new]);
        
        $status = $game->is_new ? 'ditandai sebagai baru' : 'dihapus dari baru';
        return response()->json([
            'success' => true,
            'message' => "Game berhasil {$status}!",
            'status' => $game->is_new
        ]);
    }
}
