<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Verify Your Email Address') }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        .card {
            border: 1px solid #dddddd;
            border-radius: 8px;
            overflow: hidden;
        }

        .card-header {
            background-color: #4caf50;
            color: #ffffff;
            font-size: 24px;
            padding: 20px;
        }

        .card-body {
            padding: 20px;
            font-size: 16px;
            line-height: 1.6;
        }

        a {
            color: #4caf50;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header">Congratulations {{$mailData['name']}}!!</div>
            <div class="card-body">
                <p style="color: #28a745;">You have successfully created an account. <a style="color: #f92f5b;" href="{{$mailData['link']}}">Click hare</a> to varify your email address.</p>
            </div>
        </div>
    </div>
</body>

</html>