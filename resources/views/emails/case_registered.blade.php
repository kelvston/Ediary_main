{{--<!DOCTYPE html>--}}
{{--<html>--}}
{{--<head>--}}
{{--    <title>Case Registration Successful</title>--}}
{{--</head>--}}
{{--<body>--}}
{{--<h2>Hello {{ $case['client_name'] }},</h2>--}}
{{--<p>Your case <strong>{{ $case['case_title'] }}</strong> has been successfully registered.</p>--}}
{{--<p><strong>Judge:</strong> {{ $case['judge'] }}</p>--}}
{{--<p><strong>Scheduled Date:</strong> {{ $case['case_hearing_date'] }}</p>--}}
{{--<p>Thank you for using our service.</p>--}}
{{--</body>--}}
{{--</html>--}}


    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Case Registration Successful</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333333;
            font-size: 24px;
        }

        p {
            color: #555555;
            font-size: 16px;
            line-height: 1.5;
        }

        .highlight {
            color: #007bff;
            font-weight: bold;
        }

        .case-details {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
        }

        .case-details p {
            margin: 5px 0;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 14px;
            color: #888888;
        }

        .footer a {
            color: #007bff;
            text-decoration: none;
        }

        .button {
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin-top: 20px;
        }

        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="email-container">
    <h2>Hello {{ $case['client_name'] }},</h2>
    <p>Your case <strong class="highlight">{{ $case['case_title'] }}</strong> has been successfully registered.</p>

    <div class="case-details">
        <p><strong>Judge:</strong> {{ $case['judge'] }}</p>
        <p><strong>Scheduled Date:</strong> {{ $case['case_hearing_date'] }}</p>
    </div>

    <p>Thank you for using our service.</p>

{{--    <a href="{{ route('case.details', ['id' => $case['id']]) }}" class="button">View Case Details</a>--}}

    <div class="footer">
        <p>If you have any questions, feel free to <a href="mailto:kelvinstony9@gmail.com">contact us</a>.</p>
        <p>&copy; {{ date('Y') }} Our Service. All Rights Reserved.</p>
    </div>
</div>
</body>
</html>
