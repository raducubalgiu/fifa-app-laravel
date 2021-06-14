<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Home Website
Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index'])->name('welcome');

Auth::routes();

Route::middleware('auth')->group(function() {

    // HomeApp
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Games
    Route::get('/home/games', [App\Http\Controllers\GameController::class, 'showGames'])->name('home.games');

    // Game
    Route::get('/home/{game}/game', [App\Http\Controllers\GameController::class, 'showGame'])->name('home.game');

     // Users
     Route::get('/home/users', [App\Http\Controllers\UserController::class, 'indexFrontend'])->name('home.users.index');

    // User Profile
    Route::get('/home/users/{username}/profile', [App\Http\Controllers\UserController::class, 'showProfileFrontend'])->name('home.users.profile');

     // Updating users profile
    Route::patch('/home/users/{user}/profile/update', [App\Http\Controllers\UserController::class, 'updateProfile'])->name('home.profile.update');

     // Championships
     Route::get('/home/championships', [App\Http\Controllers\ChampionshipController::class, 'championshipsIndex'])->name('home.championships.index');
 
     // Championships
     Route::get('/home/championships/{championship}/ranking', [App\Http\Controllers\ChampionshipController::class, 'championshipsRanking'])->name('home.championships.ranking');

     // Ranking
     Route::get('/home/ranking', [App\Http\Controllers\RankingController::class, 'index'])->name('home.ranking.index');

     // Statistics
     Route::get('/home/statistics', [App\Http\Controllers\StatisticController::class, 'index'])->name('home.statistics.index');

     // Route for settings
    Route::get('/home/settings', [App\Http\Controllers\SettingsController::class, 'indexHome'])->name('home.settings.index');

    // Route for report a proble
    Route::get('/home/report', [App\Http\Controllers\ReportController::class, 'indexHome'])->name('home.report.index');
});

// Routes for Super Admin
Route::middleware(['role:Subscriber', 'auth'])->group(function() {

    /****** ADMIN *******/

    // Route for admin
    Route::get('/admin', [App\Http\Controllers\AdminsController::class, 'index'])->name('admin.index');

    // Route for view all users
    Route::get('/admin/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');

    // Route for returning the creating users view
    Route::get('/admin/users/create', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');

    // Route for creating users
    Route::post('/admin/users', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');

    // Route for deleting users
    Route::delete('/admin/users/{users}/delete', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');

    // User profile
    Route::get('admin/users/{user}/profile', [App\Http\Controllers\UserController::class, 'show'])->name('users.profile.show');

    // Route for updating profile
    Route::patch('/admin/users/{user}/profile/update', [App\Http\Controllers\UserController::class, 'updateProfile'])->name('users.profile.update');

    // Route for view all tournaments
    Route::get('/admin/championships', [App\Http\Controllers\ChampionshipController::class, 'index'])->name('championships.index');

    // Route for creating tournaments
    Route::get('/admin/championships/store', [App\Http\Controllers\ChampionshipController::class, 'store'])->name('championships.store');

    // Route for deleting tournaments
    Route::delete('/admin/championships/{championship}/delete', [App\Http\Controllers\ChampionshipController::class, 'destroy'])->name('championships.destroy');

    // Route for editing tournament
    Route::get('/admin/championships/{championship}/edit', [App\Http\Controllers\ChampionshipController::class, 'edit'])->name('championships.edit');

    // Route for returning the creating users view
    Route::get('/admin/championships/{championship}/games/create', [App\Http\Controllers\ChampionshipController::class, 'createGame'])->name('championships.games.create'); 

    // Route for creating games from tournament
    Route::post('/admin/championships/game/store', [App\Http\Controllers\ChampionshipController::class, 'storeGame'])->name('championships.games.store');

    // Route for deleting games in the tournament
    Route::delete('/admin/championships/games/{game}/delete', [App\Http\Controllers\ChampionshipController::class, 'destroyGame'])->name('championships.games.destroy');

    // Route for editing games in the tournament
    Route::get('/admin/championships/games/{game}/edit', [App\Http\Controllers\ChampionshipController::class, 'editGame'])->name('championships.games.edit');

    // Route for updating games in the tournament
    Route::patch('/admin/championships/games/{game}/update', [App\Http\Controllers\ChampionshipController::class, 'updateGame'])->name('championship.games.update');

    // Route for friendlies index
    Route::get('/admin/games', [App\Http\Controllers\GameController::class, 'index'])->name('games.index');

    // Route for returning the creating friendlies view
    Route::get('/admin/games/create', [App\Http\Controllers\GameController::class, 'create'])->name('games.create');

    // Route forcreating friendlies
    Route::post('/admin/games/game/store', [App\Http\Controllers\GameController::class, 'store'])->name('games.store');

    // Route for deleting friendlies
    Route::delete('/admin/games/{game}/delete', [App\Http\Controllers\GameController::class, 'destroy'])->name('games.destroy');

    // Route for returning edit friendlies view
    Route::get('/admin/games/{game}/edit', [App\Http\Controllers\GameController::class, 'edit'])->name('games.edit');

    // Route for update friendlies
    Route::patch('/admin/games/{game}/update', [App\Http\Controllers\GameController::class, 'update'])->name('games.update');

    Route::get('admin/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('roles.index');
    Route::post('admin/roles', [App\Http\Controllers\RoleController::class, 'store'])->name('roles.store');
    Route::delete('admin/{role}/delete', [App\Http\Controllers\RoleController::class, 'destroy'])->name('roles.destroy');
    // Route for returning the update view
    Route::get('/admin/roles/{role}/edit', [App\Http\Controllers\RoleController::class, 'edit'])->name('roles.edit');
        
    // Route for updating the post
    Route::patch('/admin/roles/{role}/update', [App\Http\Controllers\RoleController::class, 'update'])->name('roles.update');

    // Route for settings
    Route::get('/admin/settings', [App\Http\Controllers\SettingsController::class, 'index'])->name('settings.index');

    // Route for report a proble
    Route::get('/admin/report', [App\Http\Controllers\ReportController::class, 'index'])->name('report.index');
    
});
