<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Item</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Edit Item</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.items.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="item_name" class="form-label">Item Name</label>
            <input type="text" name="item_name" class="form-control" value="{{ old('item_name', $item->item_name) }}" required>
        </div>

        <div class="mb-3">
            <label for="item_description" class="form-label">Description</label>
            <textarea name="item_description" class="form-control">{{ old('item_description', $item->item_description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="unit_price" class="form-label">Unit Price</label>
            <input type="number" name="unit_price" step="0.01" class="form-control" value="{{ old('unit_price', $item->unit_price) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Item</button>
        <a href="{{ route('admin.items') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
