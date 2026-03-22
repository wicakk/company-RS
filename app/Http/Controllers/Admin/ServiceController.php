<?php
// app/Http/Controllers/Admin/ServiceController.php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('sort_order')->paginate(15);
        return view('pages.admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('pages.admin.services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:100',
            'short_description' => 'required|string|max:255',
            'description'       => 'nullable|string',
            'icon'              => 'nullable|string|max:100',
            'image'             => 'nullable|image|max:2048',
            'category'          => 'nullable|string|max:100',
            'sort_order'        => 'integer',
            'is_active'         => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('services', 'public');
        }
        $validated['slug']      = Str::slug($request->name) . '-' . Str::random(4);
        $validated['is_active'] = $request->boolean('is_active', true);

        Service::create($validated);
        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil ditambahkan!');
    }

    public function edit(Service $service)
    {
        return view('pages.admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:100',
            'short_description' => 'required|string|max:255',
            'description'       => 'nullable|string',
            'icon'              => 'nullable|string|max:100',
            'image'             => 'nullable|image|max:2048',
            'category'          => 'nullable|string|max:100',
            'sort_order'        => 'integer',
            'is_active'         => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($service->image) Storage::disk('public')->delete($service->image);
            $validated['image'] = $request->file('image')->store('services', 'public');
        }
        $validated['is_active'] = $request->boolean('is_active');
        $service->update($validated);
        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil diperbarui!');
    }

    public function destroy(Service $service)
    {
        if ($service->image) Storage::disk('public')->delete($service->image);
        $service->delete();
        return back()->with('success', 'Layanan berhasil dihapus!');
    }
}
