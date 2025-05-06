<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Item</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Create New Contract</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('contracts.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="contract_id" class="form-label">Contract</label>
        </div>

        <div class="mb-3">
            <label for="user_id" class="form-label">Suppliers</label>
            <select name="user_id" class="form-control" required>
                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}">
                        {{ $supplier->company_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="user_id" class="form-label">Users</label>
            <select name="user_id" class="form-control" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" name="quantity" class="form-control" value="{{ old('quantity') }}" required>
        </div>

        <div class="mb-3">
            <label for="price_per_unit" class="form-label">Price Per Unit</label>
            <input type="number" name="price_per_unit" step="0.01" class="form-control" value="{{ old('price_per_unit') }}" required>
        </div>

        <button type="submit" class="btn btn-success">Add Contract Item</button>
        <a href="{{ route('contracts.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
</body>
</html>
