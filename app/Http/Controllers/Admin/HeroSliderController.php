<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlider;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class HeroSliderController extends Controller
{
    /**
     * GET /admin/hero-sliders
     * Tampilkan daftar semua slide + form settings footer.
     */
    public function index(): View
    {
        $slides   = HeroSlider::orderBy('order')->get();
        $settings = \App\Models\SiteSetting::instance();

        return view('pages.admin.hero-sliders.index', compact('slides', 'settings'));
    }

    /**
     * POST /admin/hero-sliders
     * Simpan slide baru.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'subtitle'     => 'nullable|string|max:500',
            'badge_text'   => 'nullable|string|max:100',
            'btn1_label'   => 'nullable|string|max:60',
            'btn1_url'     => 'nullable|string|max:255',
            'btn2_label'   => 'nullable|string|max:60',
            'btn2_url'     => 'nullable|string|max:255',
            'bg_image'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'overlay_from' => 'nullable|string|max:20',
            'overlay_mid'  => 'nullable|string|max:20',
            'overlay_to'   => 'nullable|string|max:20',
            'show_stats'   => 'nullable',
            'is_active'    => 'nullable',
        ]);

        // Upload gambar background jika ada
        if ($request->hasFile('bg_image')) {
            $data['bg_image'] = $request->file('bg_image')
                ->store('hero-sliders', 'public');
        }

        // Checkbox → boolean
        $data['show_stats'] = $request->has('show_stats');
        $data['is_active']  = $request->has('is_active');

        // Urutan paling akhir
        $data['order'] = HeroSlider::max('order') + 1;

        HeroSlider::create($data);

        return back()->with('success', 'Slide berhasil ditambahkan!');
    }

    /**
     * PUT /admin/hero-sliders/{heroSlider}
     * Update slide yang sudah ada.
     */
    public function update(Request $request, HeroSlider $heroSlider): RedirectResponse
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'subtitle'     => 'nullable|string|max:500',
            'badge_text'   => 'nullable|string|max:100',
            'btn1_label'   => 'nullable|string|max:60',
            'btn1_url'     => 'nullable|string|max:255',
            'btn2_label'   => 'nullable|string|max:60',
            'btn2_url'     => 'nullable|string|max:255',
            'bg_image'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'overlay_from' => 'nullable|string|max:20',
            'overlay_mid'  => 'nullable|string|max:20',
            'overlay_to'   => 'nullable|string|max:20',
            'show_stats'   => 'nullable',
            'is_active'    => 'nullable',
        ]);

        // Ganti gambar jika ada upload baru
        if ($request->hasFile('bg_image')) {
            // Hapus file lama dari storage
            if ($heroSlider->bg_image) {
                Storage::disk('public')->delete($heroSlider->bg_image);
            }
            $data['bg_image'] = $request->file('bg_image')
                ->store('hero-sliders', 'public');
        }

        $data['show_stats'] = $request->has('show_stats');
        $data['is_active']  = $request->has('is_active');

        $heroSlider->update($data);

        return back()->with('success', 'Slide berhasil diperbarui!');
    }

    /**
     * DELETE /admin/hero-sliders/{heroSlider}
     * Hapus slide beserta gambarnya.
     */
    public function destroy(HeroSlider $heroSlider): RedirectResponse
    {
        if ($heroSlider->bg_image) {
            Storage::disk('public')->delete($heroSlider->bg_image);
        }

        $heroSlider->delete();

        return back()->with('success', 'Slide berhasil dihapus!');
    }

    /**
     * PATCH /admin/hero-sliders/{heroSlider}/toggle
     * Toggle aktif / nonaktif.
     */
    public function toggle(HeroSlider $heroSlider): RedirectResponse
    {
        $heroSlider->update(['is_active' => ! $heroSlider->is_active]);

        $status = $heroSlider->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return back()->with('success', "Slide berhasil {$status}!");
    }

    /**
     * PATCH /admin/hero-sliders/{heroSlider}/reorder
     * Naik atau turun urutan.
     */
    public function reorder(Request $request, HeroSlider $heroSlider): RedirectResponse
    {
        $direction = $request->input('direction');

        if ($direction === 'up') {
            $heroSlider->moveUp();
        } elseif ($direction === 'down') {
            $heroSlider->moveDown();
        }

        return back();
    }
}