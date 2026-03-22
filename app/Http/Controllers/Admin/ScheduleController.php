<?php
// app/Http/Controllers/Admin/ScheduleController.php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Schedule, Doctor, Service};
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $query = Schedule::with(['doctor','service'])->latest();
        if ($request->filled('doctor_id')) { $query->where('doctor_id', $request->doctor_id); }
        $schedules = $query->paginate(20);
        $doctors   = Doctor::active()->get();
        return view('pages.admin.schedules.index', compact('schedules', 'doctors'));
    }

    public function create()
    {
        $doctors  = Doctor::active()->get();
        $services = Service::active()->get();
        return view('pages.admin.schedules.create', compact('doctors', 'services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'doctor_id'  => 'required|exists:doctors,id',
            'service_id' => 'nullable|exists:services,id',
            'day'        => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'time_start' => 'required',
            'time_end'   => 'required|after:time_start',
            'room'       => 'nullable|string|max:50',
            'quota'      => 'integer|min:1',
            'is_active'  => 'boolean',
        ]);
        $validated['is_active'] = $request->boolean('is_active', true);
        Schedule::create($validated);
        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal berhasil ditambahkan!');
    }

    public function edit(Schedule $schedule)
    {
        $doctors  = Doctor::active()->get();
        $services = Service::active()->get();
        return view('pages.admin.schedules.edit', compact('schedule', 'doctors', 'services'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $validated = $request->validate([
            'doctor_id'  => 'required|exists:doctors,id',
            'service_id' => 'nullable|exists:services,id',
            'day'        => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'time_start' => 'required',
            'time_end'   => 'required',
            'room'       => 'nullable|string|max:50',
            'quota'      => 'integer|min:1',
            'is_active'  => 'boolean',
        ]);
        $validated['is_active'] = $request->boolean('is_active');
        $schedule->update($validated);
        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal berhasil diperbarui!');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return back()->with('success', 'Jadwal berhasil dihapus!');
    }
}
