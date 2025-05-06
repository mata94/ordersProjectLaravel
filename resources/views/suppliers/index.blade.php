<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppliers List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Suppliers List</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Company Name</th>
            <th>Contact Person</th>
            <th>User</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($suppliers as $supplier)
            <tr>
                <td>{{ $supplier->company_name }}</td>
                <td>{{ $supplier->contact_person ?? 'N/A' }}</td>
                <td>{{ $supplier->user->name ?? 'Unknown User' }}</td>
                <td>
                    <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>
</body>
</html>
