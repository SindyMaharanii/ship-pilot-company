<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name', 'email', 'phone', 'company', 'subject', 
        'message', 'partnership_type', 'status', 'is_read'
    ];
    
    protected $casts = [
        'is_read' => 'boolean'
    ];
    
    public function markAsRead()
    {
        $this->update([
            'is_read' => true,
            'status' => 'read'
        ]);
    }
    
    public function markAsReplied()
    {
        $this->update(['status' => 'replied']);
    }
}