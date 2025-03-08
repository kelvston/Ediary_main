<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Case - E-Diary Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow-x: hidden; /* Prevent horizontal scroll */
            overflow-y: auto; /* Allow vertical scroll only when needed */
        }

        .container {
            margin-top: 40px;
            max-height: calc(100vh - 40px); /* Ensure it doesn't exceed the viewport height */
            overflow-y: auto; /* Add vertical scroll only when content overflows */
        }


        .card-custom {
            border-radius: 12px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
            padding: 25px;
            border-left: 5px solid #007bff;
        }

        .section-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: #007bff;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: 600;
            color: #343a40;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #ced4da;
            transition: all 0.3s ease-in-out;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .btn-custom {
            border-radius: 30px;
            padding: 12px;
            font-size: 16px;
            font-weight: 600;
            background-color: #007bff;
            color: white;
            border: none;
            transition: all 0.3s ease-in-out;
        }

        .btn-custom:hover {
            background-color: #0056b3;
        }

        .table thead {
            background-color: #007bff;
            color: white;
        }

        /* Responsive Styling */
        @media (max-width: 768px) {
            .card-custom {
                padding: 20px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    @auth
        <div class="row">
            <!-- Edit Case Form -->
            <div class="col-md-12">
                <div class="card-custom">
                    <h2 class="section-title">Edit Case Details</h2>

                    <form method="POST" action="{{ route('case.update', $case->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-folder"></i> Case Title</label>
                            <input type="text" class="form-control" name="case_title" value="{{ $case->case_title }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-user"></i> Client Name</label>
                            <input type="text" class="form-control" name="client_name" value="{{ $case->client_name }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-envelope"></i> Client Email</label>
                            <input type="email" class="form-control" name="email" value="{{ $case->email }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-phone"></i> Client Phone Number</label>
                            <input type="text" class="form-control" name="phone" value="{{ $case->phone }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-file-alt"></i> Case Brief</label>
                            <textarea class="form-control" name="case_brief">{{ $case->case_brief }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-gavel"></i> Judge</label>
                            <input type="text" class="form-control" name="judge" value="{{ $case->judge }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-calendar-alt"></i> Hearing Date</label>
                            <input type="date" class="form-control" name="case_hearing_date" value="{{ $case->case_hearing_date }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-sync-alt"></i> Recurring</label>
                            <input type="text" class="form-control" name="recurring" value="{{ $case->recurring }}">
                        </div>

                        <button type="submit" class="btn btn-custom">
                            <i class="fas fa-save"></i> Save Changes
                        </button>

                        <a href="/case" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Cases
                        </a>
                    </form>
                </div>
            </div>
        </div>
    @endauth
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
