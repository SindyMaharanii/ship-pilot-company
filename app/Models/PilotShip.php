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
        'mmsi',
        'registration_number', 
        'type', 
        'status',
        'technical_specs', 
        'capacity', 
        'length', 
        'width', 
        'draft', 
        'description', 
        'photo', 
        'gallery', 
        'is_active',
        'tracking_url',
        'tracking_provider',
        'tracking_identifier'
    ];
    
    protected $casts = [
        'gallery' => 'array',
        'is_active' => 'boolean'
    ];
    
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
    
    // Get tracking URL
    public function getTrackingUrlAttribute()
    {
        if (isset($this->attributes['tracking_url']) && $this->attributes['tracking_url']) {
            return $this->attributes['tracking_url'];
        }
        
        if ($this->mmsi) {
            return 'https://www.vesselfinder.com/?mmsi=' . $this->mmsi;
        }
        
        return null;
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