<?php
// app/Http/Controllers/Public/EducationController.php
namespace App\Http\Controllers\Public;
use App\Http\Controllers\Controller;
use App\Models\{Education, Category};
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function index(Request $request)
    {
        $query = Education::published()->with(['user','category'])->latest('published_at');
        if ($request->filled('type')) { $query->where('type', $request->type); }
        if ($request->filled('search')) { $query->where('title', 'like', '%'.$request->search.'%'); }
        $educations = $query->paginate(9);
        $categories = Category::where('type','education')->get();
        return view('pages.public.educations.index', compact('educations', 'categories'));
    }

    public function show(Education $education)
    {
        abort_if($education->status !== 'published', 404);
        $education->increment('views');
        $related = Education::published()->where('id','!=',$education->id)->take(3)->get();
        return view('pages.public.educations.show', compact('education', 'related'));
    }
}
