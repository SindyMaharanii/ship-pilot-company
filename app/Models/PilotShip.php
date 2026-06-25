<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PilotShip extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name', 
        'pilot_name',
        'pilot_photo',
        'call_sign', 
        'registration_number', 
        'type', 
        'status',
        'technical_specs', 
        'capacity', 
        'length', 
        'width', 
        'draft', 
        'speed',
        'current_latitude', 
        'current_longitude', 
        'last_position_update',
        'description', 
        'photo', 
        'gallery', 
        'is_active'
    ];
    
    protected $casts = [
        'gallery' => 'array',
        'last_position_update' => 'datetime',
        'current_latitude' => 'decimal:8',
        'current_longitude' => 'decimal:8',
        'is_active' => 'boolean'
    ];
    
    // Hitung jarak antara dua koordinat (dalam km)
    public static function hitungJarak($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371; // Radius bumi dalam km
        
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        
        $a = sin($dLat/2) * sin($dLat/2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLon/2) * sin($dLon/2);
        
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        $jarak = $earthRadius * $c; // km
        
        return $jarak;
    }
    
    // Hitung kecepatan dari 2 posisi berbeda (km/jam)
    public static function hitungKecepatan($lat1, $lon1, $time1, $lat2, $lon2, $time2)
    {
        $jarak = self::hitungJarak($lat1, $lon1, $lat2, $lon2);
        $waktu = abs(strtotime($time2) - strtotime($time1)) / 3600; // jam
        
        if ($waktu == 0) return 0;
        return round($jarak / $waktu, 2);
    }
    
    // Relation ke tracking history
    public function trackingHistory()
    {
        return $this->hasMany(ShipTrackingHistory::class)->orderBy('tracked_at', 'desc');
    }
    
    // Method untuk update posisi kapal (dengan hitung kecepatan otomatis)
    public function updatePosition($latitude, $longitude, $status = null)
    {
        // Hitung kecepatan dari posisi sebelumnya
        $kecepatan = null;
        if ($this->current_latitude && $this->current_longitude && $this->last_position_update) {
            $kecepatan = self::hitungKecepatan(
                $this->current_latitude, $this->current_longitude, $this->last_position_update,
                $latitude, $longitude, now()
            );
        }
        
        $this->current_latitude = $latitude;
        $this->current_longitude = $longitude;
        $this->last_position_update = now();
        
        if ($status) {
            $this->status = $status;
        }
        
        // Update kecepatan jika ada
        if ($kecepatan !== null) {
            $this->speed = $kecepatan;
        }
        
        $this->save();
        
        // Simpan ke history
        ShipTrackingHistory::create([
            'pilot_ship_id' => $this->id,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'status' => $this->status,
            'speed' => $kecepatan,
            'tracked_at' => now()
        ]);
        
        return $kecepatan;
    }
    
    // Get status badge untuk tampilan
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'available' => 'success',
            'on_duty' => 'info',
            'maintenance' => 'warning',
            'offline' => 'danger'
        ];
        
        return $badges[$this->status] ?? 'secondary';
    }
    
    // Get status text dalam Bahasa Indonesia
    public function getStatusTextAttribute()
    {
        $texts = [
            'available' => 'Tersedia',
            'on_duty' => 'Bertugas',
            'maintenance' => 'Perawatan',
            'offline' => 'Tidak Aktif'
        ];
        
        return $texts[$this->status] ?? $this->status;
    }
    
    // Scope untuk kapal aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    
    // Scope untuk kapal berdasarkan status
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}