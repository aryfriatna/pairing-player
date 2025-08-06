<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'player_name',
        'hcp',
        'bagtag'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function pairing()
    {
        return $this->hasOne(Pairing::class);
    }
}
