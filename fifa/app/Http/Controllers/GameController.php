<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\User;
use App\Models\Room;
use App\Models\Statistic;
use Illuminate\Support\Facades\DB;

class GameController extends Controller
{
    public function index() {
        $room = app(\App\Http\Controllers\UserController::class)->roomUser();

        $games = $room->games()->where('match_type', 'Friendly')->orderBy('id', 'desc')->paginate(5);

        return view('admin.games.index', [
            'games' => $games
        ]);
    }

    public function create() {
        $room = app(\App\Http\Controllers\UserController::class)->roomUser();

        return view('admin.games.create',[
            'room' => $room
        ]);
    }

    public function store() {
        $data = request()->validate([
            'fp_username_id' => ['required', 'max:255'],
            'firstplayer_team' => ['required', 'string', 'max:255'],
            'firstplayer_goals' => ['required', 'max:255'],
            'secondplayer_goals' => ['required', 'max:255'],
            'sp_username_id' => ['required', 'max:255'],
            'secondplayer_team' => ['required', 'string', 'max:255'],
        ]);

        // First player id
        $firstplayer_id = $data['fp_username_id'];
        // Second player id
        $secondplayer_id = $data['sp_username_id'];

        // Find first player and after that get firstname and lastname
        $firstplayer = User::findOrFail($firstplayer_id);
        // Find second player and after that get firstname and lastname
        $secondplayer = User::findOrFail($secondplayer_id);

        // Creating game
        $create = Game::create([
            'firstplayer_id' => $firstplayer_id,
            'firstplayer_username' => $firstplayer->username,
            'firstplayer_name' => $firstplayer->lastname. " " .$firstplayer->firstname,
            'firstplayer_team' => $data['firstplayer_team'],
            'firstplayer_goals' => $data['firstplayer_goals'],
            'secondplayer_id' => $secondplayer_id,
            'secondplayer_goals' => $data['secondplayer_goals'],
            'secondplayer_username' => $secondplayer->username,
            'secondplayer_name' => $secondplayer->lastname. " ". $secondplayer->firstname,
            'secondplayer_team' => $data['secondplayer_team'],
            'match_type' => 'Friendly'
        ]);

        // Getting the room
        $room = app(\App\Http\Controllers\UserController::class)->roomUser();

        // Attach createFriendly to room
        $create->rooms()->attach($room);

        /*********************** */
        /**** First player *******/

        $player_points_fp = "";
        $player_victory_fp = "";
        $player_draw_fp = "";
        $player_lose_fp = "";

        // Player points firstplayer
        if($data['firstplayer_goals'] > $data['secondplayer_goals']) {
            $player_points_fp = 3;
        } else if($data['firstplayer_goals'] === $data['secondplayer_goals']) {
            $player_points_fp = 1;
        } else {
            $player_points_fp = 0;
        }

        // Player victory firstplayer
        if($data['firstplayer_goals'] > $data['secondplayer_goals']) {
            $player_victory_fp = 1;
        } else {
            $player_victory_fp = 0;
        }

        // Player draw firstplayer
        if($data['firstplayer_goals'] === $data['secondplayer_goals']) {
            $player_draw_fp = 1;
        } else {
            $player_draw_fp = 0;
        }

        // Player lose firstplayer
        if($data['firstplayer_goals'] < $data['secondplayer_goals']) {
            $player_lose_fp = 1;
        } else {
            $player_lose_fp = 0;
        }

        /*********************** */
        /**** Second player *******/
        
        $player_points_sp = "";
        $player_victory_sp = "";
        $player_draw_sp = "";
        $player_lose_sp = "";

        // Player points secondplayer
        if($data['firstplayer_goals'] > $data['secondplayer_goals']) {
            $player_points_sp = 0;
        } else if($data['firstplayer_goals'] === $data['secondplayer_goals']) {
            $player_points_sp = 1;
        } else {
            $player_points_sp = 3;
        }

        // Player victory secondplayer
        if($data['firstplayer_goals'] < $data['secondplayer_goals']) {
            $player_victory_sp = 1;
        } else {
            $player_victory_sp = 0;
        }

        // Player draw secondplayer
        if($data['firstplayer_goals'] === $data['secondplayer_goals']) {
            $player_draw_sp = 1;
        } else {
            $player_draw_sp = 0;
        }

        // Player lose secondplayer
        if($data['firstplayer_goals'] > $data['secondplayer_goals']) {
            $player_lose_sp = 1;
        } else {
            $player_lose_sp = 0;
        }

        Statistic::create([
            'user_id' => $firstplayer_id,
            'player_username' => $firstplayer->username,
            'player_name' => $firstplayer->lastname. " ". $firstplayer->firstname,
            'player_team' => $data['firstplayer_team'],
            'player_goals' => $data['firstplayer_goals'],
            'player_goals_received' => $data['secondplayer_goals'],
            'player_points' => $player_points_fp,
            'player_victory' => $player_victory_fp,
            'player_draw' => $player_draw_fp,
            'player_lose' => $player_lose_fp,
            'game_id' => $create->id,
            'match_type' => 'Friendly'
        ]);

        Statistic::create([
            'user_id' => $secondplayer_id,
            'player_username' => $secondplayer->username,
            'player_name' => $secondplayer->lastname. " " .$secondplayer->firstname,
            'player_team' => $data['secondplayer_team'],
            'player_goals' => $data['secondplayer_goals'],
            'player_goals_received' => $data['firstplayer_goals'],
            'player_points' => $player_points_sp,
            'player_victory' => $player_victory_sp,
            'player_draw' => $player_draw_sp,
            'player_lose' => $player_lose_sp,
            'game_id' => $create->id,
            'match_type' => 'Friendly'
        ]);

        // Message
        session()->flash('create-game-friendly', 'Felicitari! Meciul a fost introdus cu succes');

        // Redirect to the friendlies index
        return redirect()->route('games.index');
    }

    // Method for deleting matches in the tournament id
    public function destroy(Game $game) {
        $game->delete();

        // Message
        session()->flash('destroy-game', 'Felicitari! Meciul a fost sters cu succes');
        
        return back();
    }

    // Method for returning edit friendlies view
    public function edit(Game $game) {
        // Room
        $room = app(\App\Http\Controllers\UserController::class)->roomUser();

        // Firstplayer users
        $firstplayerUsers = $room->users()->where('id', '!=', $game->firstplayer_id)->get();

        // Firstplayer users
        $secondplayerUsers = $room->users()->where('id', '!=', $game->secondplayer_id)->get();

        return view('admin.games.edit', [
            'firstplayerUsers' => $firstplayerUsers,
            'secondplayerUsers' => $secondplayerUsers,
            'game' => $game
        ]);
    }

    // Method for rupdating matches in the tournament id
    public function update(Game $game) {
        //Validating inputs
        $inputs = request()->validate([
            'fp_username_id' => ['required', 'max:255'],
            'firstplayer_team' => ['required', 'string', 'max:255'],
            'firstplayer_goals' => ['required', 'max:255'],
            'sp_username_id' => ['required', 'max:255'],
            'secondplayer_goals' => ['required', 'max:255'],
            'secondplayer_team' => ['required', 'string', 'max:255'],
        ]);

        $firstplayer = User::findOrFail($inputs['fp_username_id']);
        $secondplayer = User::findOrFail($inputs['sp_username_id']);

        // Firstplayer
        $game->firstplayer_id = $inputs['fp_username_id'];
        $game->firstplayer_username = $firstplayer->username;
        $game->firstplayer_name = $firstplayer->lastname. " " .$firstplayer->lastname;
        $game->firstplayer_team = $inputs['firstplayer_team'];
        $game->firstplayer_goals = $inputs['firstplayer_goals'];

        // SecondPlayer
        $game->secondplayer_id = $inputs['sp_username_id'];
        $game->secondplayer_username = $secondplayer->username;
        $game->secondplayer_name = $secondplayer->lastname. " " .$secondplayer->firstname;
        $game->secondplayer_team = $inputs['secondplayer_team'];
        $game->secondplayer_goals = $inputs['secondplayer_goals'];

        $game->update();

        // Update statistics
        $firstplayerStatistics = Statistic::where('game_id', $game->id)->where('user_id', $firstplayer->id);

        $firstplayer_points = "";
        $firstplayer_victory = "";
        $firstplayer_draw = "";
        $firstplayer_lose = "";

        // Firstplayer points
        if($inputs['firstplayer_goals'] > $inputs['secondplayer_goals']) {
            $firstplayer_points = 3;
        } else if($inputs['firstplayer_goals'] == $inputs['secondplayer_goals']) {
            $firstplayer_points = 1;
        } else {
            $firstplayer_points = 0;
        }

        // Firstplayer victory
        if($inputs['firstplayer_goals'] > $inputs['secondplayer_goals']) {
            $firstplayer_victory = 1;
        } else {
            $firstplayer_victory = 0;
        }

        // Firstplayer draw
        if($inputs['firstplayer_goals'] == $inputs['secondplayer_goals']) {
            $firstplayer_draw = 1;
        } else {
            $firstplayer_draw = 0;
        }

        // Firstplayer lose
        if($inputs['firstplayer_goals'] < $inputs['secondplayer_goals']) {
            $firstplayer_lose = 1;
        } else {
            $firstplayer_lose = 0;
        }

        // Update Firstplayer Statistics Game
        $firstplayerStatistics->update([
            'user_id' => $inputs['fp_username_id'],
            'player_username' => $firstplayer->username,
            'player_name' => $firstplayer->lastname. " " .$firstplayer->firstname,
            'player_team' => $inputs['firstplayer_team'],
            'player_goals' => $inputs['firstplayer_goals'],
            'player_goals_received' => $inputs['secondplayer_goals'],
            'player_points' => $firstplayer_points,
            'player_victory' => $firstplayer_victory,
            'player_draw' => $firstplayer_draw,
            'player_lose' => $firstplayer_lose,
            'game_id' => $game->id,
            'match_type' => 'Friendly'
        ]);

        $secondplayerStatistics = Statistic::where('game_id', $game->id)->where('user_id', $secondplayer->id);

        $firstplayer_points = "";
        $firstplayer_victory = "";
        $firstplayer_draw = "";
        $firstplayer_lose = "";

        // Firstplayer points
        if($inputs['firstplayer_goals'] < $inputs['secondplayer_goals']) {
            $secondplayer_points = 3;
        } else if($inputs['firstplayer_goals'] == $inputs['secondplayer_goals']) {
            $secondplayer_points = 1;
        } else {
            $secondplayer_points = 0;
        }

        // Firstplayer victory
        if($inputs['firstplayer_goals'] < $inputs['secondplayer_goals']) {
            $secondplayer_victory = 1;
        } else {
            $secondplayer_victory = 0;
        }

        // Firstplayer draw
        if($inputs['firstplayer_goals'] == $inputs['secondplayer_goals']) {
            $secondplayer_draw = 1;
        } else {
            $secondplayer_draw = 0;
        }

        // Firstplayer lose
        if($inputs['firstplayer_goals'] > $inputs['secondplayer_goals']) {
            $secondplayer_lose = 1;
        } else {
            $secondplayer_lose = 0;
        }

        // Update Firstplayer Statistics Game
        $secondplayerStatistics->update([
            'user_id' => $inputs['sp_username_id'],
            'player_username' => $secondplayer->username,
            'player_name' => $secondplayer->lastname. " " .$secondplayer->firstname,
            'player_team' => $inputs['secondplayer_team'],
            'player_goals' => $inputs['secondplayer_goals'],
            'player_goals_received' => $inputs['firstplayer_goals'],
            'player_points' => $secondplayer_points,
            'player_victory' => $secondplayer_victory,
            'player_draw' => $secondplayer_draw,
            'player_lose' => $secondplayer_lose,
            'game_id' => $game->id,
            'match_type' => 'Friendly'
        ]);

        session()->flash('edit-game-friendly', 'Meciul a fost editat cu succes');

        return redirect()->route('games.index');
    }

    public function showGames() {
        $room = app(\App\Http\Controllers\UserController::class)->roomUser();

        $games = $room->games()->paginate(9);

        $users = User::all();

        return view('home.games.index', [
            'games' => $games,
            'users' => $users
        ]);
    }

    public function showGame(Game $game) {
        // Firstplayer id
        $firstplayer_id = $game->firstplayer_id;

        // Secondplayer id
        $secondplayer_id = $game->secondplayer_id;

        // Firstplayer Avatar
        $firstplayer = User::where('id', $firstplayer_id)->get();
        foreach($firstplayer as $firstplayer) {
            $firstplayer_avatar = $firstplayer->avatar;
        }

        // Secondplayer Avatar
        $secondplayer = User::where('id', $secondplayer_id)->get();
        foreach($secondplayer as $secondplayer) {
            $secondplayer_avatar = $secondplayer->avatar;
        }

        // First User matches
        $firstplayer_matches = $game->where('firstplayer_id', $firstplayer_id)->orWhere('secondplayer_id', $firstplayer_id)->get();

        // Second User matches
        $secondplayer_matches = $game->where('firstplayer_id', $secondplayer_id)->orWhere('secondplayer_id', $secondplayer_id)->get();

        // Head to Head matches
        $headTohead_matches = DB::select("SELECT * FROM games WHERE (firstplayer_id = $firstplayer_id AND secondplayer_id = $secondplayer_id) OR (firstplayer_id = $secondplayer_id AND secondplayer_id = $firstplayer_id) ORDER BY id DESC");

        return view('home.game.index', [
            'game' => $game,
            'firstplayer_avatar' => $firstplayer_avatar,
            'secondplayer_avatar' => $secondplayer_avatar,
            'firstplayer_matches' => $firstplayer_matches,
            'secondplayer_matches' => $secondplayer_matches,
            'headTohead_matches' => $headTohead_matches,
        ]);
    }
}
