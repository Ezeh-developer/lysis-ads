<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Ads\Value;
use Illuminate\Support\Facades\DB;

class Ad extends Model
{
    use HasFactory,SoftDeletes; 

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

    public function getLinkByValues($values) {
        return DB::table('ads')
            ->join('ad_value', 'ads.id', '=', 'ad_value.ad_id')
            ->join('values', 'ad_value.value_id', '=', 'values.id')
            ->join('tags', 'values.tag_id', '=', 'tags.id')
            ->where([
                ['tags.name', '=', $values["firstCondition"]["tag"]],
                ['values.value', '=', $values["firstCondition"]["value"]],
                ['ads.location', '=', $values["fourthCondition"]["location"]]
            ])
            ->orWhere([
                ['tags.name', '=', $values["secondCondition"]["tag"]],
                ['values.value', '=', $values["secondCondition"]["value"]],
                ['ads.location', '=', $values["fourthCondition"]["location"]]
            ])
            ->orWhere([
                ['tags.name', '=', $values["thirdCondition"]["tag"]],
                ['values.value', '=', $values["thirdCondition"]["value"]],
                ['ads.location', '=', $values["fourthCondition"]["location"]]
            ])
            ->select('link')
            ->inRandomOrder()
            ->get();
    }
}
