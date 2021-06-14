<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index() {
        return view('admin.settings.index');
    }

    public function indexHome() {
        return view('home.settings.index');
    }
}
