<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image_path',
        'order_index',
        'status',
    ];

    // Scope to get only active images (useful for homepage)
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
