<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShipTrackingHistory extends Model
{
    use HasFactory;
    
    protected $table = 'ship_tracking_history';
    
    protected $fillable = [
        'pilot_ship_id', 'latitude', 'longitude', 'status', 
        'speed', 'heading', 'tracked_at'
    ];
    
    protected $casts = [
        'tracked_at' => 'datetime',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8'
    ];
    
    public function pilotShip()
    {
        return $this->belongsTo(PilotShip::class);
    }
}