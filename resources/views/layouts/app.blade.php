<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 h-screen bg-white shadow-md p-4">
            <h1 class="text-2xl font-bold mb-4">My Dashboard</h1>
            <ul class="space-y-2">
                <li><a href="#" class="block px-4 py-2 rounded hover:bg-gray-200">Home</a></li>
                <li><a href="#" class="block px-4 py-2 rounded hover:bg-gray-200">Users</a></li>
                <li><a href="#" class="block px-4 py-2 rounded hover:bg-gray-200">Settings</a></li>
            </ul>
        </aside>

        <!-- Content -->
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>
</body>
</html>
