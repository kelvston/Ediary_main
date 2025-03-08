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
    @if($settings->theme == 'dark')
        <link rel="stylesheet" href="{{ asset('css/dark-theme.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('css/light-theme.css') }}">
    @endif
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7fc;
        }

        html, body {
            height: 100%;
            margin: 0;
        }
        .calendar-container, .dashboard-section {
            max-height: 100%;
            overflow-y: auto;
        }
        .calendar {
            max-height: 600px; /* Adjust this value as needed */
            overflow-y: auto;
        }

        /*!* Ensure the calendar takes less width *!*/
        /*.calendar {*/
        /*    max-width: 100%;*/
        /*    height: auto;*/
        /*}*/
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
            /*background-color: #ffffff;*/
            border-radius: 8px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        /* .calendar-container dark theme */
        .calendar-container {
            background-color: {{ $settings->theme == 'dark' ? '#121212' : '#fff' }};
            color: {{ $settings->theme == 'dark' ? '#e0e0e0' : '#000' }};
        }

        /* Links inside .calendar-container */
        .calendar-container a {
            color: {{ $settings->theme == 'dark' ? '#1e90ff' : '#007bff' }};
        }

        .calendar-container a:hover {
            color: {{ $settings->theme == 'dark' ? '#ff6347' : '#0056b3' }};
        }

        /* Buttons inside .calendar-container */
        .calendar-container button {
            background-color: {{ $settings->theme == 'dark' ? '#333' : '#007bff' }};
            color: #fff;
            border: 1px solid {{ $settings->theme == 'dark' ? '#555' : '#0056b3' }};
        }

        .calendar-container button:hover {
            background-color: {{ $settings->theme == 'dark' ? '#555' : '#0056b3' }};
        }

        /* Input fields inside .calendar-container */
        .calendar-container input,
        .calendar-container select,
        .calendar-container textarea {
            background-color: {{ $settings->theme == 'dark' ? '#333' : '#fff' }};
            color: {{ $settings->theme == 'dark' ? '#e0e0e0' : '#000' }};
            border: 1px solid {{ $settings->theme == 'dark' ? '#444' : '#ccc' }};
        }

        /* Card-like elements inside .calendar-container */
        .calendar-container .card {
            background-color: {{ $settings->theme == 'dark' ? '#222' : '#fff' }};
            border: 1px solid {{ $settings->theme == 'dark' ? '#444' : '#ddd' }};
            padding: 15px;
            color: {{ $settings->theme == 'dark' ? '#e0e0e0' : '#000' }};
        }

        /* Alerts inside .calendar-container */
        .calendar-container .alert-info {
            background-color: {{ $settings->theme == 'dark' ? '#333' : '#d9edf7' }};
            color: {{ $settings->theme == 'dark' ? '#1e90ff' : '#31708f' }};
            border: 1px solid {{ $settings->theme == 'dark' ? '#444' : '#bce8f1' }};
        }

        .calendar-container .alert-warning {
            background-color: {{ $settings->theme == 'dark' ? '#333' : '#fcf8e3' }};
            color: {{ $settings->theme == 'dark' ? '#ff6347' : '#8a6d3b' }};
            border: 1px solid {{ $settings->theme == 'dark' ? '#444' : '#faebcc' }};
        }

        /* Header/Footer inside .calendar-container */
        .calendar-container header,
        .calendar-container footer {
            background-color: {{ $settings->theme == 'dark' ? '#1a1a1a' : '#f8f9fa' }};
            color: {{ $settings->theme == 'dark' ? '#e0e0e0' : '#000' }};
            padding: 10px;
        }

        /* Text inside .calendar-container */
        .calendar-container h1,
        .calendar-container h2,
        .calendar-container h3,
        .calendar-container h4 {
            color: {{ $settings->theme == 'dark' ? '#fff' : '#000' }};
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
        .notification-icon {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #ffc107;
            color: white;
            border-radius: 50%;
            padding: 10px;
            font-size: 1.5rem;
            cursor: pointer;
        }
                 #muteButton {
            position: fixed;
            top: 20px;
            right: 70px;
            background-color: #ffc107;
            color: white;
            border-radius: 50%;
            padding: 10px;
            font-size: 1.5rem;
            cursor: pointer;
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: red;
            color: white;
            border-radius: 50%;
            font-size: 0.8rem;
            padding: 5px;
        }



    </style>
</head>
<body class="{{ $settings->theme }}">
<div class="container my-2">
    @auth

        <div class="calendar-container">
            <h2 class="section-title">Welcome to Your E-Diary</h2>
            <p class="text-muted">Manage your personal or professional activities with ease.</p>

            <div id="notificationIcon" class="notification-icon" data-bs-toggle="modal" data-bs-target="#reminderModal">
                <i class="fas fa-bell"></i>
                <div id="notificationBadge" class="notification-badge">0</div>

            </div>
            <button id="muteButton" class="btn btn-warning">
                <i class="fas fa-volume-up" id="volumeIcon"></i> Mute
            </button>

{{--            <input type="date" id="case_hearing_date" class="form-control" onchange="validateRecurringOption()">--}}
            <script>
                document.addEventListener("DOMContentLoaded", validateRecurringOption);
            </script>

            <div class="modal fade" id="reminderModal" tabindex="-1" aria-labelledby="reminderModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="reminderModalLabel">Reminders</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <ul class="list-group" id="remindersList">
                                <!-- Dynamically loaded reminders will appear here -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="list-group" id="remindersList">
                <!-- This is where the reminders will be dynamically added by JavaScript -->
            </ul>
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
                        <!-- Events Section -->
                        <div class="col-md-4">
                            <div class="card-custom">
                                <h5>Events</h5>
                                <p>Track and manage upcoming events, meetings, and deadlines.</p>
                                <a href="{{ route('notes.index') }}" class="btn btn-success btn-custom">View Events</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card-custom">
                                <h5>Settings</h5>
                                <p>Customize your e-diary settings for personalized use.</p>
                                <a href="{{ route('settings') }}" class="btn btn-dark btn-custom">Go to Settings</a>
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
                        <p id="eventDate">Date</p>
                        <p id="clientName">Client Name</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="reminderModall" tabindex="-1" aria-labelledby="reminderModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="reminderModalLabel">Add Reminder</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('reminders.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Start Date</label>
                                <input type="datetime-local" name="reminder_date" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Recurring</label>
                                <select name="recurring" class="form-select">
                                    <option value="none">None</option>
                                    <option value="minute">Every Minute</option>
                                    <option value="five_minutes">Every 5 Minutes</option>
                                    <option value="daily">Daily</option>
                                    <option value="weekly">Weekly</option>
                                    <option value="monthly">Monthly</option>
                                </select>
                                <small class="text-muted" id="recurringNote">
                                    Reminders will only run until the case hearing date.
                                </small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Case (Optional)</label>
                                <select name="case_id" class="form-select">
                                    <option value="">None</option>
                                    @foreach ($cases as $case)
                                        <option value="{{ $case->id }}">{{ $case->case_title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-warning">Save Reminder</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <audio id="notificationSound" src="/reminder.mp3" preload="auto"></audio>
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
    let isMuted = false;

    document.getElementById('muteButton').addEventListener('click', () => {
        const sound = document.getElementById('notificationSound');
        const volumeIcon = document.getElementById('volumeIcon');

        isMuted = !isMuted;

        sound.muted = isMuted;

        // Change button icon and text based on mute state
        if (isMuted) {
            volumeIcon.classList.remove('fa-volume-up');
            volumeIcon.classList.add('fa-volume-mute');
            document.getElementById('muteButton').textContent = 'Unmute'; // Update button text
        } else {
            volumeIcon.classList.remove('fa-volume-mute');
            volumeIcon.classList.add('fa-volume-up');
            document.getElementById('muteButton').textContent = 'Mute'; // Update button text
        }
    });

    $(document).ready(function() {
        $('#calendar').fullCalendar({
            events: [
                    @foreach ($cases as $event)
                {
                    title: '{{ $event->case_title }}',
                    start: '{{ $event->case_hearing_date }}',
                    description: '{{ $event->case_brief }}',
                    name: '{{ $event->client_name }}'
                },
                @endforeach
            ],
            eventRender: function(event, element) {
                element.on('click', function() {
                    $('#eventTitle').text(event.title); // Set event title
                    $('#eventDescription').text(event.description); // Set event description
                    $('#eventDate').text(event.start); // Set event date
                    $('#clientName').text(event.name); // Set event date
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

    // Function to fetch and update reminders
    function fetchReminders() {
        fetch('/reminders')
            .then(response => response.json())
            .then(data => {
                const list = document.getElementById('remindersList');
                const notificationBadge = document.getElementById('notificationBadge');
                list.innerHTML = '';  // Clear the current list

                // Update notification count based on pending reminders
                const pendingReminders = data.filter(reminder => reminder.status === 'pending');
                notificationBadge.textContent = pendingReminders.length;

                if (pendingReminders.length > 0) {
                    const sound = document.getElementById('notificationSound');
                    sound.play(); // Play the notification sound
                }


                data.forEach(reminder => {
                    const listItem = document.createElement('li');
                    listItem.classList.add('list-group-item', 'd-flex', 'justify-content-between');
                    listItem.innerHTML = `
                    <span>${reminder.title} - ${reminder.reminder_date}</span>
                    <button class="btn btn-sm btn-success" onclick="markAsDone(${reminder.id})">
                        ${reminder.status === 'pending' ? 'Mark Done' : 'Undo'}
                    </button>
                `;
                    list.appendChild(listItem);
                });
            })
            .catch(error => {
                console.error('Error fetching reminders:', error);
            });
    }

    // Function to mark reminder as done or undone
    function markAsDone(reminderId) {
        fetch(`/reminders/${reminderId}/mark`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                status: 'done',  // You can toggle the status if needed (done or pending)
            }),
        })
            .then(response => response.json())
            .then(data => {
                // After marking done, refetch the reminders to update the list
                fetchReminders();
            })
            .catch(error => {
                console.error('Error marking reminder:', error);
            });
    }

    // Fetch reminders when the modal is shown
    document.getElementById('reminderModal').addEventListener('show.bs.modal', fetchReminders);



    // Automatically fetch reminders every 30 seconds (or adjust the interval as needed)
    setInterval(fetchReminders, 30000);  // 30000 ms = 30 seconds

    // Initial fetch on page load
    document.addEventListener('DOMContentLoaded', fetchReminders);


    // Call fetchReminders to update the list on page load
    document.addEventListener('DOMContentLoaded', fetchReminders);


    function markAsDone(id) {
        fetch(`/reminders/${id}/status`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        }).then(() => location.reload());
    }
    function validateRecurringOption() {
        let caseDate = new Date(document.getElementById('case_hearing_date').value);
        let now = new Date();
        let diffHours = (caseDate - now) / (1000 * 60 * 60); // Difference in hours

        let minuteOption = document.querySelector('option[value="minute"]');
        let fiveMinOption = document.querySelector('option[value="five_minutes"]');

        if (diffHours > 24) {
            minuteOption.disabled = true;
            fiveMinOption.disabled = true;
            document.getElementById('recurringNote').innerText =
                "High-frequency reminders (every 5 minutes) are disabled for cases more than a day away.";
        } else {
            minuteOption.disabled = false;
            fiveMinOption.disabled = false;
            document.getElementById('recurringNote').innerText =
                "Reminders will only run until the case hearing date.";
        }
    }

</script>
</body>
</html>
