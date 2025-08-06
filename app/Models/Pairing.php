<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pairing extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'region_id',
        'player_id',
        'teebox_name',
        'teebox',
        'flight',
        'slot_number',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function player()
    {
        return $this->belongsTo(Player::class);
    }
}
