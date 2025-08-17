<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $methods = PaymentMethod::orderBy('sort_order')->latest('id')->paginate(18);
        return view('admin.payment_methods.index', compact('methods'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'icon' => 'required|image|mimes:png,jpg,jpeg,webp,svg|max:4096',
            'name' => 'nullable|string|max:100',
            'sort_order' => 'nullable|integer|min:0|max:1000000',
        ]);

        $path = $request->file('icon')->store('payments', 'public');

        PaymentMethod::create([
            'name' => $request->input('name'),
            'icon_path' => $path,
            'is_active' => true,
            'is_online' => (bool) $request->input('is_online', true),
            'sort_order' => (int) $request->input('sort_order', 0),
        ]);

        return redirect()->back()->with('success', 'Metode pembayaran berhasil ditambahkan.');
    }

    public function update(Request $request, PaymentMethod $paymentMethod)
    {
        $request->validate([
            'icon' => 'nullable|image|mimes:png,jpg,jpeg,webp,svg|max:4096',
            'name' => 'nullable|string|max:100',
            'sort_order' => 'nullable|integer|min:0|max:1000000',
            'is_active' => 'nullable|boolean',
            'is_online' => 'nullable|boolean',
        ]);

        if ($request->hasFile('icon')) {
            if ($paymentMethod->icon_path && Storage::disk('public')->exists($paymentMethod->icon_path)) {
                Storage::disk('public')->delete($paymentMethod->icon_path);
            }
            $paymentMethod->icon_path = $request->file('icon')->store('payments', 'public');
        }

        $paymentMethod->name = $request->input('name');
        $paymentMethod->sort_order = (int) $request->input('sort_order', $paymentMethod->sort_order);
        $paymentMethod->is_active = (bool) $request->input('is_active', $paymentMethod->is_active);
        $paymentMethod->is_online = (bool) $request->input('is_online', $paymentMethod->is_online);
        $paymentMethod->save();

        return redirect()->back()->with('success', 'Metode pembayaran diperbarui.');
    }

    public function destroy(PaymentMethod $paymentMethod)
    {
        if ($paymentMethod->icon_path && Storage::disk('public')->exists($paymentMethod->icon_path)) {
            Storage::disk('public')->delete($paymentMethod->icon_path);
        }
        $paymentMethod->delete();
        return redirect()->back()->with('success', 'Metode pembayaran dihapus.');
    }

    public function toggle(PaymentMethod $paymentMethod)
    {
        $paymentMethod->is_active = ! $paymentMethod->is_active;
        $paymentMethod->save();
        return redirect()->back()->with('success', 'Status tampil diperbarui.');
    }

    public function toggleOnline(PaymentMethod $paymentMethod)
    {
        $paymentMethod->is_online = ! $paymentMethod->is_online;
        $paymentMethod->save();
        return redirect()->back()->with('success', 'Status online diperbarui.');
    }
}