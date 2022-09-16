<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ad extends Model
{
    use HasFactory; 

    protected $fillable = [
        'link',
        'clicks_hired',
        'location'
    ];

    public function values() {
        return $this->belongsToMany(Value::class)->withTimestamps();
    }

    public function getLinkByValues($values) {
        DB::table('ads')
            ->select('link',)
            ->join('ad_value', 'ads.id', '=', 'ad_value.ad_id')
            ->join('values', 'ad_value.value_id', '=', 'values.id')
            ->join('tags', 'values.tag_id', '=', 'tags.id')
            ->where([
                ['tags.name', 'like', $values["firstCondition"]["tag"]],
                ['value', 'like', $values["firstCondition"]["value"]]
            ])
            ->orWhere([
                ['tags.name', 'like', $values["secondCondition"]["tag"]],
                ['value', 'like', $values["secondCondition"]["value"]]
            ])
            ->orWhere([
                ['tags.name', 'like', $values["thirdCondition"]["tag"]],
                ['value', 'like', $values["thirdCondition"]["value"]]
            ])
            ->get();
    }
}
