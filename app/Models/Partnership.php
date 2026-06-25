<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Partnership extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'partner_name', 'logo', 'description', 'collaboration_experience',
        'partnership_opportunity', 'website', 'is_active'
    ];
    
    protected $casts = [
        'is_active' => 'boolean'
    ];
}