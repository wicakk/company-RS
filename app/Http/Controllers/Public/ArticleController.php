<?php
// app/Http/Controllers/Public/ArticleController.php
namespace App\Http\Controllers\Public;
use App\Http\Controllers\Controller;
use App\Models\{Article, Category};
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::published()->with(['user','category'])->latest('published_at');

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $articles   = $query->paginate(9);
        $categories = Category::where('type', 'article')->get();
        return view('pages.public.articles.index', compact('articles', 'categories'));
    }

    public function show(Article $article)
    {
        abort_if($article->status !== 'published', 404);
        $article->incrementViews();
        $related = Article::published()
            ->where('id', '!=', $article->id)
            ->where('category_id', $article->category_id)
            ->latest('published_at')->take(3)->get();
        return view('pages.public.articles.show', compact('article', 'related'));
    }
}
