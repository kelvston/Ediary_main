@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Update Settings</h2>
        <form method="POST" action="{{ route('settings.update', Auth::user()->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="notification_preference">Notification Preference</label>
                <select name="notification_preference" class="form-control">
                    <option value="email">Email</option>
                    <option value="sms">SMS</option>
                </select>
            </div>
            <div class="form-group">
                <label for="timezone">Timezone</label>
                <input type="text" name="timezone" class="form-control" value="Africa/Nairobi" required>
            </div>
            <div class="form-group">
                <label for="default_reminder_time">Default Reminder Time</label>
                <input type="number" name="default_reminder_time" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Settings</button>
        </form>
    </div>
@endsection
