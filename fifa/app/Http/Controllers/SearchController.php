<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SearchController extends Controller
{

    public function search(User $user) {
        $users = User::all();

        $findUsers = $users->where($users->firstname, 'like', $user->firstname)->orWhere($users->lastname, 'like', $user->lastname)->get();

        return view('admin.search.index',[
            'findUsers' => $findUsers
        ]);
    }
}
