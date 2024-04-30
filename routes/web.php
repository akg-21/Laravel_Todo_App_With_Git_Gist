<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectsController;

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/todo', function () {
    return view('todo');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    
    // Route::get('/project',function(){
    //     return view('project');
    // });
    Route::get('/statusUp/{id}', [ProjectsController::class,'statusUp'])->name('statusUp');
    Route::get('/delete/{id}',[ProjectsController::class,'destroy'])->name('delete'); 
    Route::get('/viewdata/{id}',[ProjectsController::class,'show'])->name('viewdata');
    Route::post('/update',[ProjectsController::class,'update'])->name('update');
    Route::get('/project',[ProjectsController::class,'index'])->name('view');
    Route::post('/insert',[ProjectsController::class,'store'])->name('insert');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
