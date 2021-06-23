<?php

namespace App\Http\Controllers;

use App\Models\Championship;
use App\Models\Room;
use App\Models\User;
use App\Models\Game;
use App\Models\Statistic;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

use function PHPUnit\Framework\isNull;

class ChampionshipController extends Controller
{
    // Method for displaying all the tournaments
    public function index() {
        $user = auth()->user();

        $championships = $user->championships->orderBy('id', 'desc')->paginate(5);

        return view('admin.championships.index', [
            'championships' => $championships
        ]);
    }

    // Method creating tournaments
    public function store() {
        // Instantiate the Championship Class
        $championship = new Championship();

        // Get the Championship table
        $championship_table = DB::table('championships')->get();


        // Verify if the championship table is empty
        if($championship_table->isEmpty()) {
            $id_championship_overall = 1;
        } else {
            $id_championship_overall = $championship_table->last()->id + 1;
        }

        // Get the room of the User
        $room = app(\App\Http\Controllers\UserController::class)->roomUser();

        // Get the championship table of the room
        $room_championships = $room->championships()->get();

        // Verify if the championship table of the room is empty
        if($room_championships->isEmpty()) {
            $id_championship_room = 1;
        }   else {
            $id_championship_room = $room->championships->last()->id + 1;
        }

        // Create a new Championship
        $create = $championship->create([
            'name' => 'Campionatul'.' '.'#'.$id_championship_overall,
            'slug' => 'campionatul'.' '.'#'.$id_championship_overall,
            'championship_no_of_room' => 'Campionatul'.' '.'#'.$id_championship_room
        ]);

        // Attaching the championship to the room
        $room = app(\App\Http\Controllers\UserController::class)->roomUser();
        $create->rooms()->attach($room);

        // Attaching the championship to the users's room
        foreach($room->users as $user) {
            $create->users()->attach($user);
        }
        
        // Message for the user
        session()->flash('championship-created', 'Felicitari, ai creat un nou campionat!');

        // Redirect to the championships index
        return redirect()->route('championships.index');
    }

    // Method for deleting tournaments
    public function destroy(Championship $championship) {
        $championship->delete();
        
        $championship->fresh();

        return back();
    }

    // Method editing tournaments
    public function edit(Championship $championship) {
        $games = $championship->games()->orderBy('game_id', 'desc')->paginate(5);
        $results = DB::select("SELECT user_id, player_username, player_name, player_team, COUNT(user_id) AS matches_number ,SUM(player_goals) AS player_goals, SUM(player_goals_received) AS goal_received, SUM(player_points) AS player_points, SUM(player_victory) AS player_victory, SUM(player_draw) AS player_draw, SUM(player_lose) AS player_lose FROM statistics WHERE championship_id = $championship->id GROUP BY user_id, player_username,player_name, player_team ORDER BY player_points DESC, SUM(player_goals) - SUM(player_goals_received) DESC, player_goals DESC");   

        return view('admin.championships.edit',[
            'championship' => $championship,
            'games' => $games,
            'results' => $results
        ]);
    }

    // Method for returning route for creating games in the tournament id
    public function createGame(Championship $championship) {
        $room = app(\App\Http\Controllers\UserController::class)->roomUser();

        return view('admin.championships.games.create',[
            'room' => $room,
            'championship' => $championship
        ]);
    }

    // Method for creating games in the tournament id
    public function storeGame() {
        $data = request()->validate([
            'fp_username_id' => ['required', 'max:255'],
            'firstplayer_team' => ['required', 'string', 'max:255'],
            'firstplayer_goals' => ['required', 'max:255'],
            'secondplayer_goals' => ['required', 'max:255'],
            'sp_username_id' => ['required', 'max:255'],
            'secondplayer_team' => ['required', 'string', 'max:255'],
            'championship_id' => ['required', 'max:255']
        ]);

        // First player id
        $firstplayer_id = $data['fp_username_id'];
        // Second player id
        $secondplayer_id = $data['sp_username_id'];

        // Find first player and after that get firstname and lastname
        $firstplayer = User::findOrFail($firstplayer_id);
        // Find second player and after that get firstname and lastname
        $secondplayer = User::findOrFail($secondplayer_id);

        // Creating the User
        $create = Game::create([
            'firstplayer_id' => $firstplayer_id,
            'firstplayer_username' => $firstplayer->username,
            'firstplayer_name' => $firstplayer->lastname. " " .$firstplayer->firstname,
            'firstplayer_team' => $data['firstplayer_team'],
            'firstplayer_goals' => $data['firstplayer_goals'],
            'secondplayer_id' => $secondplayer_id,
            'secondplayer_goals' => $data['secondplayer_goals'],
            'secondplayer_username' => $secondplayer->username,
            'secondplayer_name' => $secondplayer->lastname. " " .$firstplayer->firstname,
            'secondplayer_team' => $data['secondplayer_team'],
            'match_type' => 'Campionat'
        ]);

        // Getting the championship
        $championship = $data['championship_id'];

        // Attaching the match to championship
        $create->championships()->attach($championship);

        // Getting the room
        $room = app(\App\Http\Controllers\UserController::class)->roomUser();

        // Attach create to room
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
            'player_name' => $firstplayer->lastname. " " .$firstplayer->firstname,
            'player_team' => $data['firstplayer_team'],
            'player_goals' => $data['firstplayer_goals'],
            'player_goals_received' => $data['secondplayer_goals'],
            'player_points' => $player_points_fp,
            'player_victory' => $player_victory_fp,
            'player_draw' => $player_draw_fp,
            'player_lose' => $player_lose_fp,
            'game_id' => $create->id,
            'match_type' => 'Campionat',
            'championship_id' => $championship
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
            'match_type' => 'Campionat',
            'championship_id' => $championship
        ]);

        // Update winner championship in championships
        $results = DB::select("SELECT user_id, player_username, player_name, player_team, COUNT(user_id) AS matches_number ,SUM(player_goals) AS player_goals, SUM(player_goals_received) AS goal_received, SUM(player_points) AS player_points, SUM(player_victory) AS player_victory, SUM(player_draw) AS player_draw, SUM(player_lose) AS player_lose FROM statistics WHERE championship_id = $championship GROUP BY user_id, player_username,player_name, player_team ORDER BY player_points DESC, SUM(player_goals) - SUM(player_goals_received) DESC, player_goals DESC");

        $winner_championship = $results[0]->player_username;

        $championshipUpdate = Championship::where('id', $championship);

        $championshipUpdate->update([
             'winner_championship' => $winner_championship
        ]);

        // Message
        session()->flash('create-game', 'Meciul a fost introdus cu succes');

        return redirect()->route('championships.edit', $championship);

    }

    // Method for deleting matches in the tournament id
    public function destroyGame(Game $game) {
        foreach($game->championships as $championship) {
            $game->delete();

            $results = DB::select("SELECT user_id, player_username, player_name, player_team, COUNT(user_id) AS matches_number ,SUM(player_goals) AS player_goals, SUM(player_goals_received) AS goal_received, SUM(player_points) AS player_points, SUM(player_victory) AS player_victory, SUM(player_draw) AS player_draw, SUM(player_lose) AS player_lose FROM statistics WHERE championship_id = $championship->id GROUP BY user_id, player_username,player_name, player_team ORDER BY player_points DESC, SUM(player_goals) - SUM(player_goals_received) DESC, player_goals DESC");

            $winner_championship = $results[0]->player_username;

            $championshipUpdate = Championship::where('id', $championship->id);

            $championshipUpdate->update([
                'winner_championship' => $winner_championship
            ]);
        }

        // Message
        session()->flash('destroy-game', 'Meciul a fost sters cu succes');
        
        return back();
    }

    // Method for returning the edit page for matches in the tournament id
    public function editGame(Game $game) {
        // Room
        $room = app(\App\Http\Controllers\UserController::class)->roomUser();

        // Firstplayer users
        $firstplayerUsers = $room->users()->where('id', '!=', $game->firstplayer_id)->get();

        // Firstplayer users
        $secondplayerUsers = $room->users()->where('id', '!=', $game->secondplayer_id)->get();

        return view('admin.championships.games.edit', [
            'firstplayerUsers' => $firstplayerUsers,
            'secondplayerUsers' => $secondplayerUsers,
            'game' => $game
        ]);
    }

    // Method for rupdating matches in the tournament id
    public function updateGame(Game $game) {
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
        $game->firstplayer_name = $firstplayer->lastname. " ". $firstplayer->firstname;
        $game->firstplayer_team = $inputs['firstplayer_team'];
        $game->firstplayer_goals = $inputs['firstplayer_goals'];

        // SecondPlayer
        $game->secondplayer_id = $inputs['sp_username_id'];
        $game->secondplayer_username = $secondplayer->username;
        $game->secondplayer_username = $secondplayer->lastname. " " .$secondplayer->firstname;
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


        foreach($game->championships as $championship) {

            $results = DB::select("SELECT user_id, player_username, player_name, player_team, COUNT(user_id) AS matches_number ,SUM(player_goals) AS player_goals, SUM(player_goals_received) AS goal_received, SUM(player_points) AS player_points, SUM(player_victory) AS player_victory, SUM(player_draw) AS player_draw, SUM(player_lose) AS player_lose FROM statistics WHERE championship_id = $championship->id GROUP BY user_id, player_username,player_name, player_team ORDER BY player_points DESC, SUM(player_goals) - SUM(player_goals_received) DESC, player_goals DESC");

            $winner_championship = $results[0]->player_username;

            $championshipUpdate = Championship::where('id', $championship->id);

            $championshipUpdate->update([
                'winner_championship' => $winner_championship
            ]);
        }

        // Message
        session()->flash('update-game', 'Meciul a fost editat cu succes');

        return redirect()->route('championships.edit', $championship);
    }

    // Championships Index Frontend
    public function championshipsIndex() {
        $room = app(\App\Http\Controllers\UserController::class)->roomUser();
        $championships = $room->championships()->orderBy('id', 'desc')->paginate(5);


        return view('home.championships.index', [
            'championships' => $championships,
        ]);
    }

    public function championshipsRanking(Championship $championship) {
        $results = DB::select("SELECT user_id, player_username, player_name, player_team, COUNT(user_id) AS matches_number ,SUM(player_goals) AS player_goals, SUM(player_goals_received) AS goal_received, SUM(player_points) AS player_points, SUM(player_victory) AS player_victory, SUM(player_draw) AS player_draw, SUM(player_lose) AS player_lose FROM statistics WHERE championship_id = $championship->id GROUP BY user_id, player_username,player_name, player_team ORDER BY player_points DESC, SUM(player_goals) - SUM(player_goals_received) DESC, player_goals DESC");

        return view('home.championships.ranking', [
            'results' => $results,
            'championship' => $championship
        ]);
    }
}
