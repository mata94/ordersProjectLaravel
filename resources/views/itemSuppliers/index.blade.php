<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Available Items</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="display: block">
@include('common.header')
<div class="container mt-5">
    <h1 class="mb-4">Available Items for Supplier</h1>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Unit Price</th>
            <th>Quantity</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr>
                <td>{{ $item->item_name }}</td>
                <td>{{ $item->item_description }}</td>
                <td>${{ number_format($item->unit_price, 2) }}</td>
                <td>
                    <form action="{{ route('supplier-items.store') }}" method="POST" class="d-flex">
                        @csrf
                        <input type="hidden" name="item_id" value="{{ $item->id }}">
                        <input type="number" name="quantity" class="form-control me-2" min="1" value="1" required style="width: 100px;">

                        <td>
                            <button type="submit" class="btn btn-primary btn-sm">Add</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
