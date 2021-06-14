<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\User;
use App\Models\Championship;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        // User statistics
        $user = auth()->user()->statistics;

        // Championship statistics
        $championship_victories = $user->where('match_type', 'Campionat')->sum('player_victory');
        $championship_loses = $user->where('match_type', 'Campionat')->sum('player_lose');
        $championship_draw = $user->where('match_type', 'Campionat')->sum('player_draw');
        $championship_goals = $user->where('match_type', 'Campionat')->sum('player_goals');

        // Championships Winner
        $total_championships = Championship::all()->count('championship_id');
        $auth_user_name = auth()->user()->username;
        $championships_winner = Championship::where('winner_championship', $auth_user_name)->count('id');

        // Championships Percentage
        if($total_championships == 0) {
            $championship_percentage = 0;
        } else {
            $championship_percentage = round($championships_winner / $total_championships * 100);
        }

        // Victory Percentage
        if(!$user->sum('player_victory') == 0) {
            $victory_percentage = round($user->sum('player_victory')/$user->count('user_id')*100);
        } else {
            $victory_percentage = 0;
        }

        // Loses Percentage
        if(!$user->sum('player_lose') == 0) {
            $loses_percentage = round($user->sum('player_lose')/$user->count('user_id')*100);
        } else {
            $loses_percentage = 0;
        }

        // Draw Percentage
        if(!$user->sum('player_draw') == 0) {
            $draw_percentage = round($user->sum('player_draw')/$user->count('user_id')*100);
        } else {
            $draw_percentage = 0;
        }

        // Total Victories
        if($user->sum('player_victory') == 0) {
            $total_victories = 0; 
        } else {
            $total_victories = $user->sum('player_victory');
        }

        // Total Loses
        if($user->sum('player_lose') == 0) {
            $total_loses = 0;
        } else {
            $total_loses = $user->sum('player_lose');
        }

        return view('home.index', [
            'user' => $user,
            'victory_percentage' => $victory_percentage,
            'total_victories' => $total_victories,
            'total_loses' => $total_loses,
            'championships_winner' => $championships_winner,
            'loses_percentage' => $loses_percentage,
            'championship_percentage' => $championship_percentage,
            'draw_percentage' => $draw_percentage,
            'championship_victories' => $championship_victories,
            'championship_loses' => $championship_loses,
            'championship_draw' => $championship_draw,
            'championship_goals' => $championship_goals
        ]);
    }
        
}
