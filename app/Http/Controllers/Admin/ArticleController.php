<?php
// app/Http/Controllers/Admin/ArticleController.php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Article, Category};
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::with(['user','category'])->latest();
        if ($request->filled('search')) {
            $query->where('title','like','%'.$request->search.'%');
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        $articles = $query->paginate(15);
        return view('pages.admin.articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = Category::where('type','article')->get();
        return view('pages.admin.articles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'excerpt'     => 'nullable|string|max:500',
            'content'     => 'required|string',
            'thumbnail'   => 'nullable|image|max:2048',
            'type'        => 'required|in:news,announcement',
            'status'      => 'required|in:draft,published',
        ]);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('articles', 'public');
        }

        $validated['slug']       = Str::slug($request->title) . '-' . Str::random(5);
        $validated['user_id']    = auth()->id();
        $validated['published_at'] = $request->status === 'published' ? now() : null;

        Article::create($validated);
        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dibuat!');
    }

    public function edit(Article $article)
    {
        $categories = Category::where('type','article')->get();
        return view('pages.admin.articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'excerpt'     => 'nullable|string|max:500',
            'content'     => 'required|string',
            'thumbnail'   => 'nullable|image|max:2048',
            'type'        => 'required|in:news,announcement',
            'status'      => 'required|in:draft,published',
        ]);

        if ($request->hasFile('thumbnail')) {
            if ($article->thumbnail) Storage::disk('public')->delete($article->thumbnail);
            $validated['thumbnail'] = $request->file('thumbnail')->store('articles', 'public');
        }

        if ($request->status === 'published' && !$article->published_at) {
            $validated['published_at'] = now();
        }

        $article->update($validated);
        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy(Article $article)
    {
        if ($article->thumbnail) Storage::disk('public')->delete($article->thumbnail);
        $article->delete();
        return back()->with('success', 'Artikel berhasil dihapus!');
    }
}
