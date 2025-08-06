<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $fillable = [
        'region_name',
    ];

    public function eventRegions()
    {
        return $this->hasMany(EventRegion::class);
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_regions');
    }

    public function parings()
    {
        return $this->hasMany(Pairing::class);
    }
}
