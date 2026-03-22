<?php
// app/Http/Controllers/Admin/DoctorController.php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Doctor, Service, Schedule};
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DoctorController extends Controller
{
    public function index(Request $request)
    {
        $query = Doctor::with('service')->latest();
        if ($request->filled('search')) {
            $query->where('name','like','%'.$request->search.'%')
                  ->orWhere('specialization','like','%'.$request->search.'%');
        }
        $doctors = $query->paginate(15);
        return view('pages.admin.doctors.index', compact('doctors'));
    }

    public function create()
    {
        $services = Service::active()->get();
        return view('pages.admin.doctors.create', compact('services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:100',
            'specialization' => 'required|string|max:100',
            'education'      => 'nullable|string|max:200',
            'photo'          => 'nullable|image|max:2048',
            'bio'            => 'nullable|string',
            'str_number'     => 'nullable|string|max:50',
            'service_id'     => 'nullable|exists:services,id',
            'is_active'      => 'boolean',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('doctors', 'public');
        }
        $validated['slug'] = Str::slug($request->name) . '-' . Str::random(4);
        $validated['is_active'] = $request->boolean('is_active', true);

        Doctor::create($validated);
        return redirect()->route('admin.doctors.index')->with('success', 'Dokter berhasil ditambahkan!');
    }

    public function edit(Doctor $doctor)
    {
        $services  = Service::active()->get();
        $schedules = $doctor->schedules;
        return view('pages.admin.doctors.edit', compact('doctor', 'services', 'schedules'));
    }

    public function update(Request $request, Doctor $doctor)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:100',
            'specialization' => 'required|string|max:100',
            'education'      => 'nullable|string|max:200',
            'photo'          => 'nullable|image|max:2048',
            'bio'            => 'nullable|string',
            'str_number'     => 'nullable|string|max:50',
            'service_id'     => 'nullable|exists:services,id',
            'is_active'      => 'boolean',
        ]);

        if ($request->hasFile('photo')) {
            if ($doctor->photo) Storage::disk('public')->delete($doctor->photo);
            $validated['photo'] = $request->file('photo')->store('doctors', 'public');
        }
        $validated['is_active'] = $request->boolean('is_active');
        $doctor->update($validated);
        return redirect()->route('admin.doctors.index')->with('success', 'Data dokter berhasil diperbarui!');
    }

    public function destroy(Doctor $doctor)
    {
        if ($doctor->photo) Storage::disk('public')->delete($doctor->photo);
        $doctor->delete();
        return back()->with('success', 'Dokter berhasil dihapus!');
    }
}
