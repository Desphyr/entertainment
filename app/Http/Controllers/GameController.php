<?php

namespace App\Http\Controllers;

use App\Models\Game; 
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        return view('games.index', ['games' => Game::latest()->get()]);
    }

    public function store(Request $request)
    {
        $game = Game::create($request->all());
        return response()->json($game);
    }

    public function edit($id)
    {
        $game = Game::findOrFail($id);
        return response()->json($game);
    }

    public function update(Request $request, $id)
    {
        $game = Game::findOrFail($id);
        $game->update($request->all());
        return response()->json($game);
    }

    public function destroy($id)
    {
        Game::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }
}
