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

        /* Event date style */
        .fc-event.fc-event-2 {
            background-color: #28a745; /* Green for events */
            color: white;
        }

        /* Modal style */
        .modal-header {
            background-color: #007bff;
            color: white;
        }

        .modal-body {
            padding: 20px;
        }

        .notification {
            background-color: #ffc107;
            color: white;
            padding: 10px;
            border-radius: 8px;
            font-weight: bold;
        }

        /* Ensure the calendar takes less width */
        .calendar {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
<div class="container my-5">
    @auth
        <div class="calendar-container">
            <h2 class="section-title">Welcome to Your E-Diary</h2>
            <p class="text-muted">Manage your personal or professional activities with ease.</p>

            <div class="row">
                <!-- Dashboard Section (7 columns) -->
                <div class="col-md-7">
                    <div class="row">
                        <!-- Cases Section -->
                        <div class="col-md-4">
                            <div class="card-custom">
                                <h5>Cases</h5>
                                <p>View and manage all your ongoing cases and legal matters.</p>
                                <a href="/case" class="btn btn-primary btn-custom">Manage Cases</a>
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
                </div>

                <!-- Calendar Section (5 columns) -->
                <div class="col-md-5">
                    <div class="calendar">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for viewing event details -->
        <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="eventModalLabel">Event Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h6 id="eventTitle">Event Title</h6>
                        <p id="eventDescription">Event Description</p>
                    </div>
                </div>
            </div>
        </div>

    @else
        <!-- Login/Register links (Your previous layout) -->
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
    $(document).ready(function() {
        $('#calendar').fullCalendar({
            events: [
                    @foreach ($cases as $event)
                {
                    title: '{{ $event->case_title }}',
                    start: '{{ $event->case_hearing_date }}',
                    description: '{{ $event->case_brief }}'
                },
                @endforeach
            ],
            eventRender: function(event, element) {
                element.on('click', function() {
                    $('#eventTitle').text(event.title); // Set event title
                    $('#eventDescription').text(event.description); // Set event description
                    $('#eventModal').modal('show'); // Show the modal
                });

                if (event.start) {
                    element.addClass('fc-event-2');
                }
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
