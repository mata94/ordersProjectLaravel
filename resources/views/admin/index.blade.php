<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - User Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { height: 100vh; display: flex; justify-content: center; align-items: center; background-color: #f8f9fa; }
        .admin-container { max-width: 800px; width: 100%; padding: 20px; background: #ffffff; border-radius: 10px; box-shadow: 0 0 20px rgba(0,0,0,0.1); }
        .action-buttons { display: flex; gap: 5px; }
    </style>
</head>
<body style="display: block">
@include('common.header')
<div class="container admin-container">
    <h2 class="text-center mb-4">Admin - User Management</h2>

    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('admin.create_user_form') }}" class="btn btn-primary">Create New User</a>
    </div>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <div class="action-buttons">
                        <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form method="POST" action="{{ route('admin.user.destroy', $user->id) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>

                    </div>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
