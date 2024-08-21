<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Tours</title>
    <link rel="stylesheet" href="{{ asset('css/admin/tour/style.css') }}">
</head>
<body>
<div class="container">
    <header class="header">
        <h1>Manage Group and Private Tours</h1>
        <a href="{{ route('admin.index') }}" class="back-button">Back to Dashboard</a>
    </header>
    <main class="main-content">
        <section class="tours-section">
            <div class="actions">
                <a href="" class="action-button">Create New Tour</a>
            </div>

            <!-- Group Tours Section -->
            <h2>Group Tours</h2>
            <table class="tours-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Number of People</th>
                    <th>Price</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tours['group'] as $tour)
                    <tr>
                        <td>{{ $tour->id }}</td>
                        <td>{{ $tour->title }}</td>
                        <td>{{ $tour->description }}</td>
                        <td>{{ $tour->category->title }}</td>
                        <td>{{ $tour->how_many_peoples }}</td>
                        <td>${{ $tour->price }}</td>
                        <td>{{ $tour->start_date->format('Y-m-d') }}</td>
                        <td>{{ $tour->end_date->format('Y-m-d') }}</td>
                        <td>
                            <a href="" class="edit-button">Edit</a>
                            <form action="" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-button">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <!-- Private Tours Section -->
            <h2>Private Tours</h2>
            <table class="tours-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tours['private'] as $tour)
                    <tr>
                        <td>{{ $tour->id }}</td>
                        <td>{{ $tour->title }}</td>
                        <td>{{ $tour->description }}</td>
                        <td>{{ $tour->category->title }}</td>
                        <td>${{ $tour->price }}</td>
                        <td>{{ $tour->start_date->format('Y-m-d') }}</td>
                        <td>{{ $tour->end_date->format('Y-m-d') }}</td>
                        <td>
                            <a href="" class="edit-button">Edit</a>
                            <form action="" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-button">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </section>
    </main>
</div>
</body>
</html>
