<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($event_id)
    {
        $player = Player::where('event_id', $event_id)->get();
        return view('players.index', compact('player', 'event_id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($event_id)
    {
        return view('players.insert', compact('event_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $event_id)
    {
        $players = $request->input('players');

        foreach ($players as $player) {
            Player::create([
                'event_id' => $event_id,
                'player_name' => $player['name'],
                'hcp' => $player['hcp'],
                'bagtag' => $player['tag'],
            ]);
        }

        return redirect()->route('player.index', $event_id)->with('success', 'Players berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Player $player)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Player $player)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Player $player)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Player $player)
    {
        //
    }
}
