<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventRegion extends Model
{
    use HasFactory;
    protected $fillable = [
        'event_id',
        'region_id',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
