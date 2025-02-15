@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Assign Tasks</h2>
        <form method="POST" action="{{ route('tasks.assign') }}">
            @csrf
            <div class="form-group">
                <label for="case_id">Case ID</label>
                <input type="text" name="case_id" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="task_name">Task Name</label>
                <input type="text" name="task_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="assigned_to">Assigned To</label>
                <input type="text" name="assigned_to" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="due_date">Due Date</label>
                <input type="date" name="due_date" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Assign Task</button>
        </form>
    </div>
@endsection
