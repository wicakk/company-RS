<?php
// app/Http/Controllers/Public/HomeController.php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\{Article, Service, Doctor, Education, Announcement, Banner};

class HomeController extends Controller
{
    public function index()
    {
        $banners      = Banner::active()->get();
        $services     = Service::active()->orderBy('sort_order')->take(6)->get();
        $latestNews   = Article::published()->news()->latest('published_at')->take(3)->get();
        $doctors      = Doctor::active()->take(4)->get();
        $announcements = Announcement::active()->latest()->take(3)->get();
        $stats = [
            'doctors'   => Doctor::active()->count(),
            'services'  => Service::active()->count(),
            'articles'  => Article::published()->count(),
        ];

        return view('pages.public.home', compact(
            'banners', 'services', 'latestNews', 'doctors', 'announcements', 'stats'
        ));
    }
}
