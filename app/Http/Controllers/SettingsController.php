<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function updateSettings(Request $request, $id)
    {
        $settings = Settings::where('user_id', $id)->first();
        $settings->update([
            'notification_preference' => $request->notification_preference,
            'timezone' => $request->timezone,
            'default_reminder_time' => $request->default_reminder_time,
        ]);

        return response()->json(['message' => 'Settings updated successfully!', 'settings' => $settings]);
    }
}
