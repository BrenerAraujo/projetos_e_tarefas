<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('pages.dashboard.index');
})->name('dashboard');

Route::prefix('projetos')->name('projects.')->group(function () {
    Route::get('/', [ProjectController::class, 'index'])->name('index');

    Route::get('/novo', [ProjectController::class, 'create'])->name('create');
    Route::post('/store', [ProjectController::class, 'store'])->name('store');

    Route::get('/editar/{id}', [ProjectController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [ProjectController::class, 'update'])->name('update');

    Route::delete('/destroy/{id}', [ProjectController::class, 'destroy'])->name('destroy');
});

Route::prefix('tarefas')->name('tasks.')->group(function () {
    Route::get('/novo', [TaskController::class, 'create'])->name('create');
    Route::post('/store', [TaskController::class, 'store'])->name('store');

    Route::get('/editar/{id}', [TaskController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [TaskController::class, 'update'])->name('update');

    Route::delete('/destroy/{id}', [TaskController::class, 'destroy'])->name('destroy');

    Route::get('/{project_id?}', [TaskController::class, 'index'])->name('index');
});
