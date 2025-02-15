

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Diary Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.2.0/dist/fullcalendar.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7fc;
        }

        .section-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: #343a40;
        }

        .card-custom {
            border-radius: 10px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
            padding: 20px;
            margin-bottom: 20px;
        }

        .card-custom h5 {
            color: #007bff;
            font-weight: bold;
        }

        .card-custom p {
            color: #6c757d;
        }

        .btn-custom {
            border-radius: 30px;
            padding: 10px 20px;
        }

        .calendar-container, .dashboard-section {
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .calendar {
            text-align: center;
        }

        .fc-toolbar {
            background-color: #007bff;
            color: white;
            border-radius: 8px;
            padding: 10px;
        }

        .fc-button {
            background-color: #0056b3;
            border: none;
            color: white;
        }

        .fc-button:hover {
            background-color: #003f7f;
        }

        /* Responsive design for small screens */
        @media (max-width: 767px) {
            .calendar-container, .dashboard-section {
                padding: 10px;
            }
        }

        .icon-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .icon-section .fa {
            font-size: 2rem;
        }

        .row > .col-md-4 {
            margin-bottom: 20px;
        }

        /* Notification color */
        .notification {
            background-color: #ffc107;
            color: white;
            padding: 10px;
            border-radius: 8px;
            font-weight: bold;
        }

    </style>
</head>
<body>
<div class="container my-5">
    @auth
        <div class="calendar-container">
            <h2 class="section-title">Welcome to Your E-Diary</h2>
            <p class="text-muted">Manage your personal or professional activities with ease.</p>

            <!-- Calendar Section -->
            <div class="calendar mb-4">
                <div id="calendar"></div>
            </div>
        </div>

        <!-- Dashboard Sections -->
        <div class="row">
            <!-- Cases Section -->
            <div class="col-md-4">
                <div class="card-custom">
                    <h5>Cases</h5>
                    <p>View and manage all your ongoing cases and legal matters.</p>
                    <a href="/" class="btn btn-primary btn-custom">Manage Cases</a>
                </div>
            </div>

            <!-- Reminders Section -->
            <div class="col-md-4">
                <div class="card-custom">
                    <h5>Reminders</h5>
                    <p>Set and track important reminders for key dates and activities.</p>
                    <a href="/" class="btn btn-warning btn-custom">View Reminders</a>
                </div>
            </div>

            <!-- Notifications Section -->
            <div class="col-md-4">
                <div class="card-custom">
                    <h5>Notifications</h5>
                    <p>Get notified about key updates regarding your tasks and cases.</p>
                    <a href="/" class="btn btn-info btn-custom">View Notifications</a>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Events Section -->
            <div class="col-md-4">
                <div class="card-custom">
                    <h5>Events</h5>
                    <p>Track and manage upcoming events, meetings, and deadlines.</p>
                    <a href="/" class="btn btn-success btn-custom">View Events</a>
                </div>
            </div>

            <!-- Case Documents Section -->
            <div class="col-md-4">
                <div class="card-custom">
                    <h5>Case Documents</h5>
                    <p>Upload and view documents related to your cases.</p>
                    <a href="/" class="btn btn-danger btn-custom">Manage Documents</a>
                </div>
            </div>

            <!-- Tasks Section -->
            <div class="col-md-4">
                <div class="card-custom">
                    <h5>Tasks</h5>
                    <p>Manage your daily tasks, deadlines, and activities.</p>
                    <a href="/" class="btn btn-secondary btn-custom">View Tasks</a>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Settings Section -->
            <div class="col-md-12">
                <div class="card-custom">
                    <h5>Settings</h5>
                    <p>Customize your e-diary settings for personalized use.</p>
                    <a href="/" class="btn btn-dark btn-custom">Go to Settings</a>
                </div>
            </div>
        </div>

    @else
        <div class="calendar-container">
            <h2 class="section-title">Welcome to E-Diary</h2>
            <p class="text-muted">Please log in to access your dashboard.</p>

            <div class="auth-links">
                <a href="{{ route('login') }}" class="btn btn-primary btn-custom">Login</a>
                <a href="{{ route('register') }}" class="btn btn-success btn-custom">Register</a>
            </div>
        </div>
    @endauth
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Moment.js (Required for FullCalendar) -->
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>

<!-- FullCalendar JS -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.2.0/dist/fullcalendar.min.js"></script>

<script>
    {{--$(document).ready(function() {--}}
    {{--    $('#calendar').fullCalendar({--}}
    {{--        events: [--}}
    {{--                @foreach ($events as $event)--}}
    {{--            {--}}
    {{--                title: '{{ $event->title }}',--}}
    {{--                start: '{{ $event->start }}',--}}
    {{--                description: '{{ $event->description }}'--}}
    {{--            },--}}
    {{--            @endforeach--}}
    {{--        ],--}}
    {{--        eventRender: function(event, element) {--}}
    {{--            element.attr('title', event.description); // Show description on hover--}}
    {{--        },--}}
    {{--        header: {--}}
    {{--            left: 'prev,next today',--}}
    {{--            center: 'title',--}}
    {{--            right: 'month,agendaWeek,agendaDay'--}}
    {{--        },--}}
    {{--        height: 'auto',--}}
    {{--        aspectRatio: 1.8--}}
    {{--    });--}}
    {{--});--}}


    $(document).ready(function() {
        var calendar = $('#calendar').fullCalendar({
            events: [
                    @foreach ($events as $event)
                {
                    title: '{{ $event->title }}',
                    start: '{{ $event->start }}',
                    description: '{{ $event->description }}',
                    id: '{{ $event->id }}',
                    // You can add other custom fields here, such as task or notification type
                },
                @endforeach
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
            aspectRatio: 1.8,

            // Clicking on a date or event
            dayClick: function(date, jsEvent, view) {
                var selectedDate = date.format();
                loadEventsForDate(selectedDate);  // Load events/tasks for the selected date
                highlightDate(date);  // Highlight the clicked date
            },

            eventClick: function(event, jsEvent, view) {
                // Show event details in a modal or popup
                showEventDetails(event);
            }
        });

        // Function to highlight the clicked date
        function highlightDate(date) {
            $('#calendar').fullCalendar('unselect');  // Clear any previous selections
            $('#calendar').fullCalendar('gotoDate', date);  // Navigate to the clicked date
        }

        // Function to load events or tasks for the clicked date
        function loadEventsForDate(date) {
            // You can fetch events via an AJAX call to your backend
            $.ajax({
                url: '#',  // Modify with your actual route
                method: 'GET',
                data: { date: date },
                success: function(response) {
                    // Show the events or tasks related to that date
                    displayDateTasks(response.events);
                    displayNotifications(response.notifications);
                }
            });
        }

        // Function to display events/tasks for the selected date
        function displayDateTasks(events) {
            var eventsList = $('#events-list');
            eventsList.empty();  // Clear the list first

            if (Array.isArray(events) && events.length > 0) {
                events.forEach(function(event) {
                    eventsList.append('<li>' + event.title + ' - ' + event.description + '</li>');
                });
            } else {
                eventsList.append('<li>No events found for this date.</li>');  // Show a message if no events
            }
        }


        // Function to display notifications for the selected date
        function displayNotifications(notifications) {
            var notificationsList = $('#notifications-list');
            notificationsList.empty();  // Clear the list first

            if (Array.isArray(notifications) && notifications.length > 0) {
                notifications.forEach(function(notification) {
                    notificationsList.append('<li>' + notification.message + ' - ' + notification.date + '</li>');
                });
            } else {
                notificationsList.append('<li>No notifications found for this date.</li>');  // Show a message if no notifications
            }
        }


        // Function to show event details in a modal or popup
        function showEventDetails(event) {
            $('#eventModal .modal-title').text(event.title);
            $('#eventModal .modal-body').html('<p>' + event.description + '</p>');
            $('#eventModal').modal('show');
        }
    });

</script>
</body>
</html>
