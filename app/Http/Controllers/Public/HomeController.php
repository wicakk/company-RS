<?php

namespace App\Http\Controllers\Public;
use App\Models\SiteSetting;

use App\Http\Controllers\Controller;
use App\Models\HeroSlider;
use App\Models\Banner;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\Article;
use App\Models\Announcement;

class HomeController extends Controller
{
    public function index()
    {
        // ── Hero / Banners ────────────────────────────────────
        $heroSlides = HeroSlider::active()->get();
        $banners    = Banner::active()->get();

        // ── Stats ─────────────────────────────────────────────
        $stats = [
            'doctors'  => Doctor::active()->count(),
            'services' => Service::active()->count(),
            'articles' => Article::published()->count(),
        ];

        // ── Main Content ──────────────────────────────────────
        $services      = Service::active()->orderBy('sort_order')->take(6)->get();
        $doctors       = Doctor::active()->with('service')->take(4)->get();
        $latestNews    = Article::published()->news()->latest('published_at')->take(3)->get();
        $announcements = Announcement::active()->latest()->take(3)->get();

        return view('pages.public.home', compact(
            'heroSlides',
            'banners',
            'stats',
            'services',
            'doctors',
            'latestNews',
            'announcements',
        ));
    }
}