<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Pairing;
use Illuminate\Http\Request;

class PairingController extends Controller
{
    public function index($event_id)
    {
        $event = Event::with(['regions', 'players'])->findOrFail($event_id);
        $pairings = Pairing::with('player')
            ->where('event_id', $event_id)
            ->get();
        // dd($pairings, $event->regions);
        return view('pairing.index', compact('event', 'pairings'));
    }

    public function set(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'player_id' => 'required|exists:players,id',
            'region_id' => 'required|exists:regions,id',
            'teebox_name' => 'required|string',
            'teebox' => 'required|string',
            'slot_number' => 'required|integer|min:1|max:4',
            'flight' => 'required|in:A,B,C',
        ]);

        Pairing::updateOrCreate(
            ['player_id' => $validated['player_id'], 'event_id' => $validated['event_id']],
            $validated
        );

        return response()->json(['success' => true]);
    }

    public function remove(Request $request)
    {
        $request->validate(['pairing_id' => 'required|exists:pairings,id']);
        Pairing::destroy($request->pairing_id);
        return response()->json(['success' => true]);
    }
}
