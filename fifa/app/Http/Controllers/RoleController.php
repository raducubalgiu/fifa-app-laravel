<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    public function index(Role $role) {
        return view('admin.roles.index', [
            'roles' => Role::all()
        
            ]);
    }

    public function store() {
        request()->validate([
            'name' => 'required'
        ]);

        Role::create([
            'name' => Str::ucfirst(request('name')),
            'slug' => Str::of(Str::lower(request('name')))->slug('-')
        ]);

        return back();
    }

    // Method for deleting roles
    public function destroy(Role $role) {
        $role->delete();

        return back();
    }

    // Method for returning the update view
    public function edit(Role $role) {
        return view('admin.roles.edit', ['role' => $role]);
    }

    // Method for updating the role
    public function update(Role $role) {
        request()->validate([
            'name' => 'required'
        ]);

        $role->update([
            'name' => Str::ucfirst(request('name')),
            'slug' => Str::of(Str::lower(request('name')))->slug('-')
        ]);

        return redirect()->route('roles.index');

        session()->flash('role-updated', 'Role Update'.request('name'));
    }
}
