<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PromoController extends Controller
{
    public function index()
    {
        $promos = Promo::orderBy('sort_order')->latest('id')->paginate(12);
        return view('admin.promos.index', compact('promos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:150',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'description' => 'nullable|string|max:1000',
            'is_visible' => 'nullable|boolean',
        ]);

        $path = $request->file('image')->store('promos', 'public');

        $promo = Promo::create([
            'title' => $request->input('title'),
            'image_path' => $path,
            'description' => $request->input('description'),
            'is_visible' => (bool) $request->input('is_visible', true),
            'sort_order' => (int) ($request->input('sort_order', 0)),
        ]);

        return redirect()->back()->with('success', 'Promo berhasil ditambahkan.');
    }

    public function update(Request $request, Promo $promo)
    {
        $request->validate([
            'title' => 'nullable|string|max:150',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'description' => 'nullable|string|max:1000',
            'is_visible' => 'nullable|boolean',
            'sort_order' => 'nullable|integer|min:0|max:1000000',
        ]);

        if ($request->hasFile('image')) {
            if ($promo->image_path && Storage::disk('public')->exists($promo->image_path)) {
                Storage::disk('public')->delete($promo->image_path);
            }
            $promo->image_path = $request->file('image')->store('promos', 'public');
        }

        $promo->title = $request->input('title', $promo->title);
        $promo->description = $request->input('description');
        $promo->is_visible = (bool) $request->input('is_visible', $promo->is_visible);
        $promo->sort_order = (int) $request->input('sort_order', $promo->sort_order);
        $promo->save();

        return redirect()->back()->with('success', 'Promo berhasil diperbarui.');
    }

    public function destroy(Promo $promo)
    {
        if ($promo->image_path && Storage::disk('public')->exists($promo->image_path)) {
            Storage::disk('public')->delete($promo->image_path);
        }
        $promo->delete();
        return redirect()->back()->with('success', 'Promo berhasil dihapus.');
    }

    public function toggleVisibility(Promo $promo)
    {
        $promo->is_visible = ! $promo->is_visible;
        $promo->save();
        return redirect()->back()->with('success', 'Status promo diperbarui.');
    }
}