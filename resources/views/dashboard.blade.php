<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        .logout-btn {
            background: #dc3545;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .logout-btn:hover {
            background: #c82333;
        }
        .success {
            background: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Dashboard</h1>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>

        <div class="success">
            <strong>Login berhasil!</strong> Selamat datang di dashboard.
        </div>

        <div class="content">
            <h2>Selamat datang, {{ auth()->user()->name ?? 'User' }}!</h2>
            <p>Anda berhasil login dan redirect ke dashboard bekerja dengan baik.</p>

            <h3>Informasi User:</h3>
            <ul>
                <li><strong>Nama:</strong> {{ auth()->user()->name ?? 'N/A' }}</li>
                <li><strong>Email:</strong> {{ auth()->user()->email ?? 'N/A' }}</li>
                <li><strong>Login pada:</strong> {{ now()->format('d M Y H:i:s') }}</li>
            </ul>
        </div>
    </div>
</body>
</html>
