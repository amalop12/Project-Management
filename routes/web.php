<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TimeEntryController;

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

Route::get('/', [ProjectController::class, 'index'])->name('project');
Route::post('project/store', [ProjectController::class, 'store'])->name('project.store');

Route::get('task/', [TaskController::class, 'index'])->name('task');
Route::post('task/store', [TaskController::class, 'store'])->name('task.store');

Route::get('time_entry/', [TimeEntryController::class, 'index'])->name('time_entry');
Route::post('time_entry/store', [TimeEntryController::class, 'store'])->name('time.store');

Route::get('report/', [TimeEntryController::class, 'report'])->name('time.report');
Route::get('search/', [TimeEntryController::class, 'search'])->name('search');

Route::get('view/', [TimeEntryController::class, 'view'])->name('time.view');
