@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create Reminder</h2>
        <form method="POST" action="{{ route('reminders.create') }}">
            @csrf
            <div class="form-group">
                <label for="case_id">Case ID</label>
                <input type="text" name="case_id" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="reminder_text">Reminder Text</label>
                <textarea name="reminder_text" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="reminder_date">Reminder Date</label>
                <input type="datetime-local" name="reminder_date" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Create Reminder</button>
        </form>
    </div>
@endsection
