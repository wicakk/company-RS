<?php
// app/Http/Controllers/Admin/EducationController.php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Education, Category};
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class EducationController extends Controller
{
    public function index(Request $request)
    {
        $query = Education::with(['user','category'])->latest();
        if ($request->filled('search')) { $query->where('title','like','%'.$request->search.'%'); }
        if ($request->filled('status')) { $query->where('status', $request->status); }
        $educations = $query->paginate(15);
        return view('pages.admin.educations.index', compact('educations'));
    }

    public function create()
    {
        $categories = Category::where('type','education')->get();
        return view('pages.admin.educations.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'excerpt'     => 'nullable|string|max:500',
            'content'     => 'nullable|string',
            'thumbnail'   => 'nullable|image|max:2048',
            'video_url'   => 'nullable|url|max:255',
            'type'        => 'required|in:article,video,infographic',
            'status'      => 'required|in:draft,published',
        ]);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('educations','public');
        }
        $validated['slug']         = Str::slug($request->title) . '-' . Str::random(5);
        $validated['user_id']      = auth()->id();
        $validated['published_at'] = $request->status === 'published' ? now() : null;

        Education::create($validated);
        return redirect()->route('admin.educations.index')->with('success', 'Konten edukasi berhasil dibuat!');
    }

    public function edit(Education $education)
    {
        $categories = Category::where('type','education')->get();
        return view('pages.admin.educations.edit', compact('education', 'categories'));
    }

    public function update(Request $request, Education $education)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'excerpt'     => 'nullable|string|max:500',
            'content'     => 'nullable|string',
            'thumbnail'   => 'nullable|image|max:2048',
            'video_url'   => 'nullable|url|max:255',
            'type'        => 'required|in:article,video,infographic',
            'status'      => 'required|in:draft,published',
        ]);

        if ($request->hasFile('thumbnail')) {
            if ($education->thumbnail) Storage::disk('public')->delete($education->thumbnail);
            $validated['thumbnail'] = $request->file('thumbnail')->store('educations','public');
        }
        if ($request->status === 'published' && !$education->published_at) {
            $validated['published_at'] = now();
        }
        $education->update($validated);
        return redirect()->route('admin.educations.index')->with('success', 'Konten edukasi berhasil diperbarui!');
    }

    public function destroy(Education $education)
    {
        if ($education->thumbnail) Storage::disk('public')->delete($education->thumbnail);
        $education->delete();
        return back()->with('success', 'Konten edukasi berhasil dihapus!');
    }
}
