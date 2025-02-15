<?php

namespace App\Http\Controllers;

use App\Models\Reminder;
use App\Models\User;
use App\Notifications\ReminderNotification;
use Illuminate\Http\Request;

class ReminderController extends Controller
{
    public function createReminder(Request $request)
    {
        $reminder = Reminder::create([
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
}
