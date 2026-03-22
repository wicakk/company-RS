<?php
// app/Http/Controllers/Admin/DashboardController.php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Article, Doctor, Service, Contact, User, Education};

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'users'     => User::count(),
            'articles'  => Article::count(),
            'doctors'   => Doctor::count(),
            'services'  => Service::count(),
            'educations'=> Education::count(),
            'contacts'  => Contact::unread()->count(),
        ];
        $latestContacts = Contact::latest()->take(5)->get();
        $latestArticles = Article::with('user')->latest()->take(5)->get();
        return view('pages.admin.dashboard', compact('stats', 'latestContacts', 'latestArticles'));
    }
}
