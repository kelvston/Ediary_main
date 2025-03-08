<?php

namespace App\Http\Controllers;

use App\Models\DiarySetting;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function index()
    {
        // Retrieve the user's current settings
        $settings = DiarySetting::where('user_id', Auth::id())->first();

        // If settings do not exist, create default settings
        if (!$settings) {
            $settings = new DiarySetting();
            $settings->user_id = Auth::id();
            $settings->save();
        }

        return view('settings.index', compact('settings'));
    }

    public function saveSettings(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'email_notifications' => 'required|boolean',
            'language' => 'required|string|max:5',
            'date_format' => 'required|string|max:10',
            'time_format' => 'required|string|max:5',
            'theme' => 'required|in:light,dark',
            'font_size' => 'required|in:small,medium,large',
            'background_image' => 'nullable|string|max:255',
            'privacy' => 'required|in:private,friends,public',
            'text_formatting' => 'required|in:normal,bold,italic',
            'reminders' => 'required|boolean',
            'export_enabled' => 'required|boolean',
            'multiple_diaries' => 'required|boolean',
            'cloud_backup' => 'required|in:google_drive,dropbox,none',
        ]);

        // Find or create the user's settings
        $settings = DiarySetting::firstOrCreate(['user_id' => Auth::id()]);

        // Update the settings with the new values from the request
        $settings->update([
            'email_notifications' => $request->email_notifications,
            'language' => $request->language,
            'date_format' => $request->date_format,
            'time_format' => $request->time_format,
            'theme' => $request->theme,
            'font_size' => $request->font_size,
            'background_image' => $request->background_image,  // You should handle file uploads for this
            'privacy' => $request->privacy,
            'text_formatting' => $request->text_formatting,
            'reminders' => $request->reminders,
            'export_enabled' => $request->export_enabled,
            'multiple_diaries' => $request->multiple_diaries,
            'cloud_backup' => $request->cloud_backup,
        ]);

        // Redirect back to the settings page with a success message
        return redirect()->route('settings')->with('success', 'Settings have been updated successfully!');
    }

}
