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
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 40px;
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
            <!-- Add New Case Form -->
            <div class="col-md-5">
                <div class="card-custom">
                    <h2 class="section-title">Add New Case</h2>

                    <!-- Success Message -->
                    @if(session('success'))
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                        </div>
                    @endif

                    <form action="/case/store" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="case_title" class="form-label"><i class="fas fa-folder"></i> Case Title & Number</label>
                            <input type="text" id="case_title" name="case_title" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="client_name" class="form-label"><i class="fas fa-user"></i> Client Name</label>
                            <input type="text" id="client_name" name="client_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label"><i class="fas fa-envelope"></i> Client Email</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label"><i class="fas fa-phone"></i> Client Phone Number</label>
                            <input type="text" id="phone" name="phone" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="case_brief" class="form-label"><i class="fas fa-file-alt"></i> Case Brief</label>
                            <textarea id="case_brief" name="case_brief" class="form-control" rows="3" required  placeholder="Hearing, mention, necessary orders, etc."></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="case_hearing_date" class="form-label"><i class="fas fa-calendar-alt"></i> Schedule</label>
                            <input type="date" id="case_hearing_date" name="case_hearing_date" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-custom w-100"><i class="fas fa-save"></i> Save Case</button>
                    </form>
                </div>
            </div>

            <!-- Registered Cases -->
            <div class="col-md-7">
                <div class="card-custom">
                    <h2 class="section-title">Registered Cases</h2>

                    @if(session('error'))
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Case Title</th>
                                <th>Client</th>
                                <th>Schedule</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cases as $key => $case)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $case->case_title }}</td>
                                    <td>{{ $case->client_name }}</td>
                                    <td>{{ $case->case_hearing_date }}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>
                                        <a href="#" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                        <form action="#" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            @if($cases->isEmpty())
                                <tr>
                                    <td colspan="5" class="text-center text-muted">No cases registered yet.</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
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
