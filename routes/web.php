<?php

use App\Http\Controllers\RecycleController;
use App\Http\Controllers\Gistcontroller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\ProjectsController;

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/recycle', function () {
    return view('recycle');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // Route::get('/project',function(){
    //     return view('project');
    // });

    Route::get('/recover_all', [RecycleController::class, 'restoreall'])->name('recover_all');
    Route::get('/recover_project/{id}', [RecycleController::class, 'restoreproject'])->name('recover_project');
    Route::get('/recover_todo/{id}', [RecycleController::class, 'restoretodos'])->name('recover_todo');
    Route::get('/recycle', [RecycleController::class, 'index'])->name('recycle');
    //route for gist
    Route::get('/create_gist/{id}', [Gistcontroller::class, 'createGist'])->name('create_gist');
    //toto routes starts
    Route::get('/statusUp_todo/{id}', [TodoController::class, 'statusUp'])->name('statusUp_todo');
    Route::get('/delete_todo/{id}', [TodoController::class, 'destroy'])->name('delete_todo');
    Route::get('/view_todo/{id}', [TodoController::class, 'index'])->name('view_todo');
    Route::post('/insert_todo', [TodoController::class, 'store'])->name('insert_todo');
    Route::get('/vieweditdata_todo/{todo_id}', [TodoController::class, 'show'])->name('vieweditdata_todo');
    Route::post('/update_todo', [TodoController::class, 'update'])->name('update_todo');
    //project routes starts
    Route::get('/statusUp/{id}', [ProjectsController::class, 'statusUp'])->name('statusUp');
    Route::get('/delete/{id}', [ProjectsController::class, 'destroy'])->name('delete');
    Route::get('/viewdata/{id}', [ProjectsController::class, 'show'])->name('viewdata');
    Route::post('/update', [ProjectsController::class, 'update'])->name('update');
    Route::get('/project', [ProjectsController::class, 'index'])->name('view');
    Route::post('/insert', [ProjectsController::class, 'store'])->name('insert');
    //project routes ends
    //profile routes starts
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //profile routes ends
});

require __DIR__ . '/auth.php';
