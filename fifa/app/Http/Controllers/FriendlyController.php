<?php

namespace App\Http\Controllers;

use App\Models\Friendly;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Game;

class FriendlyController extends Controller
{
    public function index() {
        $friendlies = Friendly::all();

        return view('admin.friendlies.index', [
            'friendlies' => $friendlies
        ]);
    }

    public function create() {
        $room = app(\App\Http\Controllers\UserController::class)->roomUser();

        return view('admin.friendlies.create',[
            'room' => $room
        ]);
    }

    public function store() {
        $data = request()->validate([
            'firstplayer_name' => ['required', 'max:255'],
            'firstplayer_team' => ['required', 'string', 'max:255'],
            'firstplayer_goals' => ['required', 'max:255'],
            'secondplayer_goals' => ['required', 'max:255'],
            'secondplayer_name' => ['required', 'max:255'],
            'secondplayer_team' => ['required', 'string', 'max:255'],
        ]);

        // First player id
        $firstplayer_id = $data['firstplayer_name'];
        // Second player id
        $secondplayer_id = $data['secondplayer_name'];

        // Find first player and after that get firstname and lastname
        $firstplayer = User::findOrFail($firstplayer_id);
        // Find second player and after that get firstname and lastname
        $secondplayer = User::findOrFail($secondplayer_id);

        $firstplayer_victory = '';
        $secondplayer_victory = '';
        $firstplayer_points = '';
        $secondplayer_points = '';

        // Set firstplayer_victory
        if($data['firstplayer_goals'] > $data['secondplayer_goals']) {
            $firstplayer_victory = 1;
        } else {
            $firstplayer_victory = 0;
        }

        // Set secondplayer_victory
        if($data['secondplayer_goals'] > $data['firstplayer_goals']) {
            $secondplayer_victory = 1;
        } else {
            $secondplayer_victory = 0;
        }

        // Set firstplayer_points
        if($data['firstplayer_goals'] > $data['secondplayer_goals']) {
            $firstplayer_points = 3;
        } else if($data['firstplayer_goals'] === $data['secondplayer_goals']) {
            $firstplayer_points = 1;
        } else {
            $firstplayer_points = 0;
        }

        // Set secondplayer_points
        if($data['secondplayer_goals'] > $data['firstplayer_goals']) {
            $secondplayer_points = 3;
        } else if($data['secondplayer_goals'] === $data['firstplayer_goals']) {
            $secondplayer_points = 1;
        } else {
            $secondplayer_points = 0;
        }

        // Creating the User
        $createFriendly = Friendly::create([
            'firstplayer_id' => $firstplayer_id,
            'firstplayer_firstname' => $firstplayer->firstname,
            'firstplayer_lastname' => $firstplayer->lastname,
            'firstplayer_team' => $data['firstplayer_team'],
            'firstplayer_goals' => $data['firstplayer_goals'],
            'secondplayer_id' => $secondplayer_id,
            'secondplayer_goals' => $data['secondplayer_goals'],
            'secondplayer_firstname' => $secondplayer->firstname,
            'secondplayer_lastname' => $secondplayer->lastname,
            'secondplayer_team' => $data['secondplayer_team'],
            'match_type' => 'Friendly',
            'firstplayer_victory' => $firstplayer_victory,
            'secondplayer_victory' => $secondplayer_victory,
            'firstplayer_points' => $firstplayer_points,
            'secondplayer_points' => $secondplayer_points
        ]);

        // Getting the room
        $room = app(\App\Http\Controllers\UserController::class)->roomUser();

        // Attach createFriendly to room
        $createFriendly->rooms()->attach($room);

        // Message
        session()->flash('create-game-friendly', 'Felicitari! Meciul a fost introdus cu succes');

        // Redirect to the friendlies index
        return redirect()->route('friendlies.index');
    }

    // Method for deleting matches in the tournament id
    public function destroy(Friendly $friendly) {
        $friendly->delete();

        // Message
        session()->flash('destroy-game', 'Felicitari! Meciul a fost sters cu succes');
        
        return back();
    }

    // Method for returning edit friendlies view
    public function edit(Friendly $friendly) {
        // Room
        $room = app(\App\Http\Controllers\UserController::class)->roomUser();

        // Firstplayer users
        $firstplayerUsers = $room->users()->where('id', '!=', $friendly->firstplayer_id)->get();

        // Firstplayer users
        $secondplayerUsers = $room->users()->where('id', '!=', $friendly->secondplayer_id)->get();

        return view('admin.friendlies.edit', [
            'firstplayerUsers' => $firstplayerUsers,
            'secondplayerUsers' => $secondplayerUsers,
            'friendly' => $friendly
        ]);
    }

    // Method for rupdating matches in the tournament id
    public function update(Friendly $friendly) {
        //Validating inputs
        $inputs = request()->validate([
            'firstplayer_name' => ['required', 'max:255'],
            'firstplayer_team' => ['required', 'string', 'max:255'],
            'firstplayer_goals' => ['required', 'max:255'],
            'secondplayer_name' => ['required', 'max:255'],
            'secondplayer_goals' => ['required', 'max:255'],
            'secondplayer_team' => ['required', 'string', 'max:255'],
        ]);

        $firstplayer = User::findOrFail($inputs['firstplayer_name']);
        $secondplayer = User::findOrFail($inputs['secondplayer_name']);

        // Firstplayer
        $friendly->firstplayer_id = $inputs['firstplayer_name'];
        $friendly->firstplayer_firstname = $firstplayer->firstname;
        $friendly->firstplayer_lastname = $firstplayer->lastname;
        $friendly->firstplayer_team = $inputs['firstplayer_team'];
        $friendly->firstplayer_goals = $inputs['firstplayer_goals'];

        // SecondPlayer
        $friendly->secondplayer_id = $inputs['secondplayer_name'];
        $friendly->secondplayer_firstname = $secondplayer->firstname;
        $friendly->secondplayer_lastname = $secondplayer->lastname;
        $friendly->secondplayer_team = $inputs['secondplayer_team'];
        $friendly->secondplayer_goals = $inputs['secondplayer_goals'];

        $friendly->update();

        session()->flash('edit-game-friendly', 'Meciul a fost editat cu succes');

        return redirect()->route('friendlies.index');
    }
}
