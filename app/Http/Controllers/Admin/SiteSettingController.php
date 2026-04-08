<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class SiteSettingController extends Controller
{
    /**
     * GET /admin/site-settings
     * Redirect ke hero-sliders (form settings ada di sana).
     */
    public function index(): RedirectResponse
    {
        return redirect()->route('admin.hero-sliders.index');
    }

    /**
     * PUT /admin/site-settings
     * Update semua pengaturan situs (logo, footer, kontak, sosmed).
     */
    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'hospital_name'      => 'required|string|max:100',
            'hospital_tagline'   => 'nullable|string|max:150',
            'logo'               => 'nullable|image|mimes:png,jpg,jpeg,svg,webp|max:2048',
            'favicon'            => 'nullable|image|mimes:png,ico,jpg,jpeg|max:512',
            'address'            => 'nullable|string|max:500',
            'phone'              => 'nullable|string|max:30',
            'email'              => 'nullable|email|max:100',
            'hours'              => 'nullable|string|max:100',
            'footer_description' => 'nullable|string|max:500',
            'copyright_text'     => 'nullable|string|max:200',
            'social_facebook'    => 'nullable|string|max:255',
            'social_twitter'     => 'nullable|string|max:255',
            'social_instagram'   => 'nullable|string|max:255',
            'social_youtube'     => 'nullable|string|max:255',
            'social_whatsapp'    => 'nullable|string|max:30',
        ]);

        $settings = SiteSetting::instance();

        // Upload logo jika ada
        if ($request->hasFile('logo')) {
            if ($settings->logo) {
                Storage::disk('public')->delete($settings->logo);
            }
            $data['logo'] = $request->file('logo')->store('site', 'public');
        } else {
            unset($data['logo']);
        }

        // Upload favicon jika ada
        if ($request->hasFile('favicon')) {
            if ($settings->favicon) {
                Storage::disk('public')->delete($settings->favicon);
            }
            $data['favicon'] = $request->file('favicon')->store('site', 'public');
        } else {
            unset($data['favicon']);
        }

        $settings->update($data);

        return back()->with('success', 'Pengaturan situs berhasil disimpan!');
    }

    /**
     * DELETE /admin/site-settings/logo
     * Hapus logo saja.
     */
    public function deleteLogo(): RedirectResponse
    {
        $settings = SiteSetting::instance();

        if ($settings->logo) {
            Storage::disk('public')->delete($settings->logo);
            $settings->update(['logo' => null]);
        }

        return back()->with('success', 'Logo berhasil dihapus!');
    }

    /**
     * DELETE /admin/site-settings/favicon
     * Hapus favicon saja.
     */
    public function deleteFavicon(): RedirectResponse
    {
        $settings = SiteSetting::instance();

        if ($settings->favicon) {
            Storage::disk('public')->delete($settings->favicon);
            $settings->update(['favicon' => null]);
        }

        return back()->with('success', 'Favicon berhasil dihapus!');
    }
}