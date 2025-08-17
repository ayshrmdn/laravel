<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Promo;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = [
            'logo' => Setting::get('logo', 'images/logo.png'),
            'site_name' => Setting::get('site_name', 'MPOELOT'),
            'site_description' => Setting::get('site_description', 'Situs Game Online Terpercaya'),
            'support_agent_image' => Setting::get('support_agent_image', null),
            'gif_banner' => Setting::get('gif_banner', null),
        ];

        $promos = Promo::orderBy('sort_order')->latest('id')->paginate(6);
        $paymentMethods = PaymentMethod::orderBy('sort_order')->latest('id')->paginate(12);

        return view('admin.settings.index', compact('settings', 'promos', 'paymentMethods'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name' => 'nullable|string|max:255',
            'site_description' => 'nullable|string|max:500',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'support_agent_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gif_banner' => 'nullable|mimes:gif|max:10240', // Max 10MB for GIF
        ]);

        // Update site name
        if ($request->filled('site_name')) {
            Setting::set('site_name', $request->site_name);
        }

        // Update site description
        if ($request->filled('site_description')) {
            Setting::set('site_description', $request->site_description);
        }

        // Update logo
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            $oldLogo = Setting::get('logo');
            if ($oldLogo && $oldLogo !== 'images/logo.png' && Storage::exists('public/' . $oldLogo)) {
                Storage::delete('public/' . $oldLogo);
            }

            // Store new logo
            $logoPath = $request->file('logo')->store('logos', 'public');
            Setting::set('logo', $logoPath, 'image');
        }

        // Update support agent image
        if ($request->hasFile('support_agent_image')) {
            // Delete old support agent image if exists
            $oldSupportAgentImage = Setting::get('support_agent_image');
            if ($oldSupportAgentImage && Storage::disk('public')->exists($oldSupportAgentImage)) {
                Storage::disk('public')->delete($oldSupportAgentImage);
            }

            // Store new support agent image
            $supportAgentImagePath = $request->file('support_agent_image')->store('support-agents', 'public');
            Setting::set('support_agent_image', $supportAgentImagePath, 'image');
        }

        // Update GIF banner
        if ($request->hasFile('gif_banner')) {
            // Delete old GIF banner if exists
            $oldGifBanner = Setting::get('gif_banner');
            if ($oldGifBanner && Storage::disk('public')->exists($oldGifBanner)) {
                Storage::disk('public')->delete($oldGifBanner);
            }

            // Store new GIF banner
            try {
                $gifBannerPath = $request->file('gif_banner')->store('gif-banners', 'public');
                Setting::set('gif_banner', $gifBannerPath, 'file');
            } catch (\Exception $e) {
                return redirect()->route('admin.settings.index')->with('error', 'Gagal upload GIF: ' . $e->getMessage());
            }
        }

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan berhasil diperbarui!');
    }

    public function deleteGifBanner(Request $request)
    {
        $gifBanner = Setting::get('gif_banner');
        
        // Delete file from storage
        if ($gifBanner && Storage::disk('public')->exists($gifBanner)) {
            Storage::disk('public')->delete($gifBanner);
        }
        
        // Delete setting from database
        Setting::where('key', 'gif_banner')->delete();
        
        // Return JSON response for AJAX or redirect for form submission
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'message' => 'GIF Banner berhasil dihapus!']);
        }
        
        return redirect()->route('admin.settings.index')->with('success', 'GIF Banner berhasil dihapus!');
    }

    public function deleteSupportAgentImage(Request $request)
    {
        $supportAgentImage = Setting::get('support_agent_image');
        
        // Delete file from storage
        if ($supportAgentImage && Storage::disk('public')->exists($supportAgentImage)) {
            Storage::disk('public')->delete($supportAgentImage);
        }
        
        // Delete setting from database
        Setting::where('key', 'support_agent_image')->delete();
        
        // Return JSON response for AJAX or redirect for form submission
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Support Agent Image berhasil dihapus!']);
        }
        
        return redirect()->route('admin.settings.index')->with('success', 'Support Agent Image berhasil dihapus!');
    }
}
