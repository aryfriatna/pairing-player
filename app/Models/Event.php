<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_name',
        'event_date',
        'method',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function players()
    {
        return $this->hasMany(Player::class);
    }

    public function eventRegions()
    {
        return $this->hasMany(EventRegion::class);
    }

    public function regions()
    {
        return $this->belongsToMany(Region::class, 'event_regions');
    }

    public function pairings()
    {
        return $this->hasMany(Pairing::class);
    }
}
