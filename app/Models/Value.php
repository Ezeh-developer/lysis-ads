<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
        'tag_id'
    ];

    public function tag(){
        return $this->belongsTo(Tag::class);
    }

    public function ads() {
        return $this->belongsToMany(Ad::class)->withTimestamps();
    }
}
