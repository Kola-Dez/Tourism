<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/admin/admin-style.css') }}">
</head>
<body>
<div class="container">
    <header class="header">
        <h1>Admin Dashboard</h1>
        <form action="{{ route('admin.logout') }}" method="post" class="logout-form">
            @csrf
            <button type="submit" class="logout-button">Logout</button>
        </form>
    </header>
    <main class="main-content">
        <section class="welcome-section">
            <h2>Welcome to the Admin Dashboard</h2>
            <p>Here you can manage your application's content and settings.</p>
        </section>
        <section class="actions-section">
            <div class="action-card">
                <h3>Manage Users</h3>
                <p>View and manage users of your application.</p>
                <a href="{{ route('admin.tours.index') }}">Go to Users</a>
            </div>
            <div class="action-card">
                <h3>Settings</h3>
                <p>Update application settings and preferences.</p>
                <a href="#">Go to Settings</a>
            </div>
            <!-- Add more action cards as needed -->
        </section>
    </main>
    <footer class="footer">
        <p>&copy; 2024 Admin Dashboard. All rights reserved.</p>
    </footer>
</div>
</body>
</html>
