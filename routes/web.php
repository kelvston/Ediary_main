<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\CaseController;
use App\Models\Reminder;
use App\Models\Task;
use App\Models\Settings;
use App\Models\CaseFile;

Route::post('/tasks/assign', [TaskController::class, 'assignTask']);
Route::post('/reminders/create', [ReminderController::class, 'createReminder']);
Route::put('/settings/update/{id}', [SettingsController::class, 'updateSettings']);
Route::get('/case', [CaseController::class, 'index']);
Route::post('/case/store', [CaseController::class, 'createCase']);


Route::post('/', [TaskController::class, 'dashboard']);
Route::get('/', function () {
    $reminders = Reminder::all();
    $cases = CaseFile::all();
    $tasks = Task::all();
    $settings = Settings::first(); // Assuming there's only one record for settings

    // Return the 'ediary.index' view, passing data
    return view('ediary.index', compact('reminders', 'tasks', 'settings'));
});

Route::get('/dashboard', function () {
    $events = Task::all();
    $user_id = Auth::user()->id;
    $reminders = Reminder::all();
    $cases = CaseFile::where('lawyer_id', $user_id)->get();
    $tasks = Task::all();
    $settings = Settings::first();
    return view('dashboard', compact('events','reminders', 'cases', 'tasks', 'settings'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
