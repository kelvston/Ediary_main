<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Diary Dashboard - Case Management</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body, html {
            height: 100%;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            overflow-y: auto; /* Allow vertical scrolling */
        }

        .container {
            max-width: 1000px;
            padding: 0 15px;
            width: 100%;
        }

        .card-custom {
            border-radius: 12px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
            padding: 30px;
            border-left: 5px solid #007bff;
            margin: 20px 0;
            max-height: 90vh; /* Prevent overflowing the viewport */
            overflow-y: auto; /* Enable scrolling for content inside the card */
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
            padding: 12px;
            font-size: 1rem;
            margin-bottom: 10px;
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
            width: 100%;
            margin-top: 20px;
            transition: all 0.3s ease-in-out;
        }

        .btn-custom:hover {
            background-color: #0056b3;
        }

        /* Responsive Styling */
        @media (max-width: 768px) {
            .section-title {
                font-size: 1.5rem;
            }

            .form-control {
                font-size: 0.9rem;
            }

            .btn-custom {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    @auth
        <div class="row justify-content-center">
            <!-- Case Details -->
            <div class="col-md-12">
                <div class="card-custom">
                    <h2 class="section-title">Case Details</h2>

                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-folder"></i> Case Title</label>
                        <p class="form-control">{{ $case->case_title }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-user"></i> Client Name</label>
                        <p class="form-control">{{ $case->client_name }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-envelope"></i> Client Email</label>
                        <p class="form-control">{{ $case->email }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-phone"></i> Client Phone Number</label>
                        <p class="form-control">{{ $case->phone }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-file-alt"></i> Case Brief</label>
                        <p class="form-control">{{ $case->case_brief }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-gavel"></i> Judge</label>
                        <p class="form-control">{{ $case->judge }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-calendar-alt"></i> Hearing Date</label>
                        <p class="form-control">{{ $case->case_hearing_date }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-sync-alt"></i> Recurring</label>
                        <p class="form-control">{{ $case->recurring }}</p>
                    </div>

                    <a href="/case" class="btn btn-custom">
                        <i class="fas fa-arrow-left"></i> Back to Cases
                    </a>
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
