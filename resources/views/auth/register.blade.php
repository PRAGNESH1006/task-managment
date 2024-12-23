<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Our Team</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #F5F3FF;
        }
        .container {
            background-color: white;
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        .logo {
            width: 80px;
            height: 80px;
            margin: 0 auto 1rem;
            display: block;
            border-radius: 50%;
        }
        h2 {
            text-align: center;
            margin-bottom: 1rem;
        }
        p {
            text-align: center;
            font-size: 0.875rem;
            margin-bottom: 1.5rem;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input, select {
            margin-bottom: 1rem;
            padding: 0.5rem;
            border: 1px solid #D1D5DB;
            border-radius: 0.25rem;
        }
        button {
            background-color: #4F46E5;
            color: white;
            padding: 0.75rem;
            border: none;
            border-radius: 0.25rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #4338CA;
        }
        .error-message {
            background-color: #D1FAE5;
            color: #065F46;
            padding: 0.75rem;
            margin-bottom: 1rem;
            font-size: 0.875rem;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="/"><img src="{{ asset('images/Myapp.Webp') }}" alt="{{ config('app.name') }} Logo" class="logo"></a>
        <h2>Join Our Team</h2>
        <p>Already have an account? <a href="{{ route('login') }}" style="color: #4F46E5;">Sign in</a></p>
        
        <!-- Form now submits to the backend server -->
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <input type="text" id="name" name="name" placeholder="Full Name" required>
            <input type="email" id="email" name="email" placeholder="Email address" required>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required>
            
            <select id="role" name="role" required>
                <option value="">Select Your Role</option>
                <option value="admin">Admin</option>
                <option value="employee">Employee</option>
                <option value="manager">Client</option>
            </select>
            
            <!-- Display error messages from server -->
            @if ($errors->any())
                <div class="error-message">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
