<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Ads\Value;

class Ad extends Model
{
    use HasFactory; 

    protected $fillable = [
        'image',
        'views_hired',
        'location',
        'link',
        'current_views'
    ];

    public function values() {
        return $this->belongsToMany(Value::class)->withTimestamps();
    }
}
