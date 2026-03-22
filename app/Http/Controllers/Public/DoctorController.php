<?php
// app/Http/Controllers/Public/DoctorController.php
namespace App\Http\Controllers\Public;
use App\Http\Controllers\Controller;
use App\Models\{Doctor, Service};
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index(Request $request)
    {
        $query = Doctor::active()->with(['service', 'schedules']);

        if ($request->filled('service')) {
            $query->where('service_id', $request->service);
        }
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('specialization', 'like', '%' . $request->search . '%');
        }

        $doctors  = $query->paginate(12);
        $services = Service::active()->get();
        return view('pages.public.doctors.index', compact('doctors', 'services'));
    }

    public function show(Doctor $doctor)
    {
        $schedules = $doctor->schedules()->where('is_active', true)
            ->orderByRaw("FIELD(day,'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu')")
            ->get();
        return view('pages.public.doctors.show', compact('doctor', 'schedules'));
    }
}
