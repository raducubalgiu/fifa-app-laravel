<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Room;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use RegistersUsers;
use App\Http\Controllers\Auth;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image As Image;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Method for showing all users (friends)
    public function index() {
        // Find room
        $room = $this->roomUser();

        // Find users from the room, except auth user
        $users = $room->users()->where('id', '!=', auth()->user()->id)->paginate(5);

        return view('admin.users.index', ['users' => $users]);
    }

    // Method for returning the view for creating users
    public function create(User $users) {
        $users = auth()->user();

        return view('admin.users.create', ['users' => $users]);
    }

    // Register users from admin
    public function store() {
        
        $data = request()->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:12', 'unique:users', 'alpha_dash'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Creating the User
        $create = User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'avatar' => 'user.png'
        ]);

        // Find the room
        $room = $this->roomUser();

        // Create Ranking
        $create->rankings()->create([
            'player_username' => $data['username'],
            'player_firstname' => $data['firstname'],
            'player_lastname' => $data['lastname']
        ]);

        // Attaching 
        $create->rooms()->attach($room);

        // Assingning Admin role
        $role = Role::where('slug', 'subscriber')->get();

        // Attaching role
        $create->roles()->attach($role);

        // Message
        session()->flash('create-user', 'Felicitari! Ai adaugat cu succes inca un prieten in camera voastra de joaca');

        // Return to users index
        return redirect()->route('users.index');
    }

    // Method for deleting users
    public function destroy(User $users) {
        $users->delete();
        
        return back();
    }

    // Method for attaching roles
    public function attach(User $user) {
        $user->championships()->attach(request('championship'));

        return back();
    }

    // Method for room's user
    public function roomUser() {
        foreach(auth()->user()->rooms as $room) {
            return $room;
        }
    }

    // Displaying User Profile
    public function show(User $user) {
        return view('admin.users.profile', [
            'user' => $user,
            'roles' => Role::all()
        ]);
    }

    // Updating Profile
    public function updateProfile(User $user) {
        
        $inputs = request()->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:12', 'alpha_dash', Rule::unique('users', 'username')->ignore($user->id)],
            'email' => ['required', 'string', 'email', 'max:255'],
            'avatar' => ['file'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $inputs['password'] = Hash::make($inputs['password']);
 
        if(request('avatar')) {
            $avatar = request('avatar');
            $extension = $avatar->getClientOriginalName();
            $filename = time().'.'.$extension;
            $avatar->move('images', $filename);
            //$resizedImage = Image::make(public_path('images'/$filename))->fit(400, 400)->save();

            $inputs['avatar'] = $filename;
        }

        // Checking if the user changed the username and update
        $user->update($inputs);

        // Update User in rankings
        $user->rankings()->update([
            'player_username' => $inputs['username'],
            'player_firstname' => $inputs['firstname'],
            'player_lastname' => $inputs['lastname'],
        ]);

        // Message
        session()->flash('update-profile', 'Felicitari! Ai updatat profilul tau cu succes');

        return back();
    }

    // Showing all users in Frontend
    public function indexFrontend() {
        $room = $this->roomUser();
        $users = $room->users()->where('id', '!=', auth()->user()->id)->paginate(10);

        return view('home.users.index', [
            'users' => $users
        ]);
    }

    // Method for user profile Frontend
    public function showProfileFrontend() {
        $user = auth()->user();

        return view('home.users.profile', [
            'user' => $user
        ]);
    }
}
