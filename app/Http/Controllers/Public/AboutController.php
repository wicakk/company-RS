<?php
// app/Http/Controllers/Public/AboutController.php
namespace App\Http\Controllers\Public;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    public function index()
    {
        return view('pages.public.about');
    }
}
