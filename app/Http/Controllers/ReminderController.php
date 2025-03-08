<?php

namespace App\Http\Controllers;

use App\Models\CaseReminder;
use App\Models\Reminder;
use App\Models\User;
use App\Notifications\ReminderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReminderController extends Controller
{
    public function createReminder(Request $request)
    {
        $reminder = CaseReminder::create([
            'case_id' => $request->case_id,
            'user_id' => $request->user_id,
            'reminder_text' => $request->reminder_text,
            'reminder_date' => $request->reminder_date,
            'status' => 'pending',
        ]);

        // Send notification
        $user = User::find($request->user_id);
        $user->notify(new ReminderNotification($reminder));

        return response()->json(['message' => 'Reminder created successfully!', 'reminder' => $reminder]);
    }

    public function index()
    {
        $reminders = CaseReminder::where('user_id', Auth::id())->where('status','pending')->orderBy('reminder_date', 'asc')->get();
        return response()->json($reminders);
    }

    public function store(Request $request)
    {


        $request->validate([
            'title' => 'required|string|max:255',
            'reminder_date' => 'required|date',
            'recurring' => 'in:none,daily,weekly,monthly,minute,five_minutes',

        ]);

        CaseReminder::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'reminder_date' => $request->reminder_date,
            'recurring' => $request->recurring,
            'status' => 'pending',
            'case_id' => $request->case_id
        ]);

        return redirect()->back()->with('success', 'Reminder added successfully!');
    }

    public function updateStatus($id)
    {
        $reminder = CaseReminder::where('user_id', Auth::id())->findOrFail($id);
        $reminder->status = $reminder->status === 'pending' ? 'completed' : 'pending';
        $reminder->save();

        return response()->json(['message' => 'Status updated successfully']);
    }

    public function destroy($id)
    {
        CaseReminder::where('user_id', Auth::id())->findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Reminder deleted!');
    }

}
