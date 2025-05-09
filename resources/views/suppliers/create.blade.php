<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Supplier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Create New Supplier</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('suppliers.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="company_name" class="form-label">Company Name</label>
            <input type="text" name="company_name" class="form-control" value="{{ old('company_name') }}" required>
        </div>

        <div class="mb-3">
            <label for="contact_person" class="form-label">Contact Person</label>
            <input type="text" name="contact_person" class="form-control" value="{{ old('contact_person') }}">
        </div>

        <div class="mb-3">
            <label for="user_id" class="form-label">User</label>
            <select name="user_id" class="form-select" required>
                <option value="">-- Select User --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Save Supplier</button>
        <a href="{{ route('admin.suppliers') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
</body>
</html>
