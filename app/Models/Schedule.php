<?php
// app/Models/Schedule.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = ['doctor_id','service_id','day','time_start','time_end','room','quota','is_active'];
    protected $casts = ['is_active' => 'boolean'];

    public function doctor() { return $this->belongsTo(Doctor::class); }
    public function service() { return $this->belongsTo(Service::class); }

    public function getTimeRangeAttribute(): string
    {
        return substr($this->time_start, 0, 5) . ' - ' . substr($this->time_end, 0, 5);
    }
}
