<?php

namespace App\Http\Controllers;

use App\Models\CaseFile;
use App\Models\Reminder;
use App\Models\Settings;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function dashboard()
    {
        $user_id = Auth::user()->id;
        $reminders = Reminder::all();
        $cases = CaseFile::where('lawyer_id', $user_id)->get();
        $tasks = Task::all();
        $settings = Settings::first();
        return view('ediary.index', compact('reminders', 'tasks', 'settings','cases'));
    }

    public function assignTask(Request $request)
    {
        $task = Task::create([
            'case_id' => $request->case_id,
            'task_name' => $request->task_name,
            'assigned_to' => $request->assigned_to,
            'due_date' => $request->due_date,
            'status' => 'pending',
        ]);

        return response()->json(['message' => 'Task assigned successfully!', 'task' => $task]);
    }
}
