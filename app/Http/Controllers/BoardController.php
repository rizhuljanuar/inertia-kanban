<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    public function index()
    {
        return inertia('Boards/Index', [
            'boards' => auth()->user()->boards
        ]);
    }

    public function show(Board $board)
    {
        $board->load([
            'lists.cards' => fn ($query) => $query->orderBy('position')
        ]);

        return inertia('Boards/Show', [
            'board' => $board
        ]);
    }

    public function store()
    {
        request()->validate([
            'name' => ['required']
        ]);

        Board::create([
            'user_id' => auth()->id(),
            'name' => request('name')
        ]);

        return redirect()->back();
    }

    public function update(Board $board)
    {
        request()->validate([
            'name' => ['required']
        ]);

        $board->update(['name' => request('name')]);

        return redirect()->back();
    }
}
