<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Statistic;
use App\Models\Championship;

class AdminsController extends Controller
{

    public function index() {
        $user = auth()->user();

        // Get the room of the User
        $room = app(\App\Http\Controllers\UserController::class)->roomUser();

        // Last PLayers Added
        $users = $room->users()->orderBy('id', 'desc')->paginate(4);

        // Friends Added
        $totalPlayers = $room->users->count('user_id');

        // Total Championships
        $totalChampionships = $room->championships->count('id');

        // Total Matches championships
        $championshipsGames = $room->games->where('match_type', 'Campionat')->count('id');

        // Total Friendly games
        $friendlyGames = $room->games->where('match_type', 'Friendly')->count('id');

        

        return view('admin.index', [
            'totalPlayers' => $totalPlayers,
            'totalChampionships' => $totalChampionships,
            'championshipsGames' => $championshipsGames,
            'friendlyGames' => $friendlyGames,
            'users' => $users
        ]);
    }
}
