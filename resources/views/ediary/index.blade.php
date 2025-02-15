<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Diary</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.2.0/dist/fullcalendar.min.css" rel="stylesheet">

    <!-- Custom CSS (Optional) -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
        }

        .calendar-container {
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            margin-top: 20px;
            color: #007bff;
        }

        .calendar {
            text-align: center;
        }

        /* Customize FullCalendar appearance */
        .fc-toolbar {
            background-color: #007bff;
            color: white;
            border-radius: 8px;
            padding: 10px;
        }

        .fc-toolbar .fc-button {
            background-color: #0056b3;
            border: none;
            color: white;
        }

        .fc-toolbar .fc-button:hover {
            background-color: #003f7f;
        }

        .fc-day-grid .fc-day-number {
            color: #333;
            font-weight: bold;
        }

        .fc-event {
            background-color: #28a745;
            border: none;
            color: white;
        }

        .fc-event:hover {
            background-color: #218838;
        }

        .auth-links a {
            text-decoration: none;
            color: #007bff;
        }

        .auth-links a:hover {
            text-decoration: underline;
        }

        /* Make the calendar responsive */
        @media (max-width: 767px) {
            .calendar-container {
                padding: 10px;
            }
        }
    </style>
</head>

<body class="bg-light">
<div class="container my-5">

    <!-- Guest View (Calendar and Auth Links) -->
    <div class="calendar-container">
        <h2 class="section-title">Welcome to E-Diary</h2>
        <p>Please log in to view your reminders and tasks.</p>

        <div class="calendar">
            <!-- FullCalendar will be initialized here -->
            <div id="calendar"></div>
        </div>

        <div class="auth-links">
            <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
            <a href="{{ route('register') }}" class="btn btn-success">Register</a>
        </div>
    </div>

</div>

<!-- jQuery (Make sure this is above FullCalendar) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Moment.js (Required for FullCalendar) -->
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>

<!-- FullCalendar JS -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.2.0/dist/fullcalendar.min.js"></script>

<script>
    $(document).ready(function() {
        $('#calendar').fullCalendar({
            events: [
                { title: 'Sample Event', start: '2025-02-16', description: 'This is a sample event!' },
                { title: 'Meeting', start: '2025-02-18', description: 'Important meeting with the team.' }
            ],
            eventRender: function(event, element) {
                element.attr('title', event.description); // Show description on hover
            },
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            height: 'auto',
            aspectRatio: 1.8
        });
    });
</script>

</body>

</html>
