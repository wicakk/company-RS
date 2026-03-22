<?php
// app/Http/Controllers/Public/ServiceController.php
namespace App\Http\Controllers\Public;
use App\Http\Controllers\Controller;
use App\Models\{Service, Doctor, Schedule};

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::active()->orderBy('sort_order')->get();
        return view('pages.public.services.index', compact('services'));
    }

    public function show(Service $service)
    {
        $doctors = Doctor::active()->where('service_id', $service->id)->get();
        $schedules = Schedule::with('doctor')
            ->where('service_id', $service->id)
            ->where('is_active', true)
            ->orderByRaw("FIELD(day,'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu')")
            ->get()
            ->groupBy('day');
        return view('pages.public.services.show', compact('service', 'doctors', 'schedules'));
    }
}
