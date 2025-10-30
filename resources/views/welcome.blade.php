<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Manager</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            color: #333;
            background-color: #f5f5f5;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 2rem;
        }
        header {
            background-color: #4a6fa5;
            color: white;
            text-align: center;
            padding: 2rem 0;
            margin-bottom: 2rem;
        }
        h1 {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }
        .subtitle {
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }
        .btn {
            display: inline-block;
            background-color: #4a6fa5;
            color: white;
            padding: 0.8rem 1.5rem;
            text-decoration: none;
            border-radius: 4px;
            margin-right: 1rem;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #3a5a8c;
        }
        .features {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin: 2rem 0;
        }
        .feature {
            flex-basis: 30%;
            background-color: white;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .feature h3 {
            color: #4a6fa5;
        }
        footer {
            text-align: center;
            padding: 1rem 0;
            margin-top: 2rem;
            background-color: #333;
            color: white;
        }
    </style>
</head>
<body>
    <header>
        <h1>Event Manager</h1>
        <p class="subtitle">Organize and manage your events with ease</p>
        <div>
            <a href="{{ route('login') }}" class="btn">Login</a>
            <a href="{{ route('register') }}" class="btn">Register</a>
        </div>
    </header>

    <div class="container">
        <div class="features">
            <div class="feature">
                <h3>Event Planning</h3>
                <p>Create and manage events with detailed information, categories, and scheduling.</p>
            </div>
            <div class="feature">
                <h3>Registration Management</h3>
                <p>Handle attendee registrations, track attendance, and manage capacity.</p>
            </div>
            <div class="feature">
                <h3>Analytics</h3>
                <p>Get insights into your events with detailed analytics and reporting.</p>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; {{ date('Y') }} Event Manager. All rights reserved.</p>
    </footer>
</body>
</html>