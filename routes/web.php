<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\CaseController;
use App\Http\Controllers\NoteController;
use App\Models\CaseReminder;
use App\Models\Task;
use App\Models\DiarySetting;
use App\Models\CaseFile;

Route::post('/tasks/assign', [TaskController::class, 'assignTask']);
Route::post('/reminders/create', [ReminderController::class, 'createReminder']);
Route::put('/settings/update/{id}', [SettingsController::class, 'updateSettings']);
Route::get('/case', [CaseController::class, 'index']);
Route::post('/case/store', [CaseController::class, 'createCase']);
Route::delete('/case/{id}', [CaseController::class, 'destroy'])->name('case.destroy');
Route::get('/case/{id}', [CaseController::class, 'show'])->name('case.show');
Route::get('/case/{id}/edit', [CaseController::class, 'edit'])->name('case.edit');
Route::put('/case/{id}', [CaseController::class, 'update'])->name('case.update');
Route::post('/cases/{id}/notify', [CaseController::class, 'notify'])->name('cases.notify');
Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
Route::post('/save-settings', [SettingsController::class, 'saveSettings'])->name('settings.save');


Route::post('/', [TaskController::class, 'dashboard']);
Route::get('/', function () {
    $reminders = CaseReminder::all();
    $cases = CaseFile::all();
    $tasks = Task::all();
    $settings = DiarySetting::first(); // Assuming there's only one record for settings

    // Return the 'ediary.index' view, passing data
    return view('ediary.index', compact('reminders', 'tasks', 'settings'));
});

Route::get('/dashboard', function () {
    $events = Task::all();
    $user_id = Auth::user()->id;
//    $reminders = CaseReminder::all();
    $reminders = CaseReminder::paginate(10);  // Change the number to suit your needs

    $cases = CaseFile::where('lawyer_id', $user_id)->get();
    $tasks = Task::all();
    $settings = DiarySetting::first();
    return view('dashboard', compact('events','reminders', 'cases', 'tasks', 'settings'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/reminders', [ReminderController::class, 'index'])->name('reminders');
    Route::post('/reminders', [ReminderController::class, 'store'])->name('reminders.store');
    Route::post('/reminders/{id}/status', [ReminderController::class, 'updateStatus'])->name('reminders.updateStatus');
    Route::delete('/reminders/{id}', [ReminderController::class, 'destroy'])->name('reminders.destroy');
    Route::get('/index_note', [NoteController::class, 'index'])->name('notes.index');
    Route::post('/notes', [NoteController::class, 'store']);
    Route::delete('/notes/{note}', [NoteController::class, 'destroy']);
    Route::post('/notes/{note}/position', [NoteController::class, 'updatePosition']);
    Route::post('/notes/{noteId}/color', [NoteController::class, 'updateColor']);
    Route::post('/notes/{id}/update', [NoteController::class, 'update']);


});
//Route::post('/send-sms', [ReminderController::class, 'send']);
require __DIR__ . '/auth.php';
