<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactInfo extends Model
{
    use HasFactory;

    protected $table = 'contacts_info';

    protected $fillable = [
        'address', 'phone', 'email', 'description',
        'map_embed', 'facebook', 'instagram', 'twitter',
        'linkedin', 'whatsapp'
    ];
}