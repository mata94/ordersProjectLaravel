<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $supplier->company_name }} - Added Items</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Items Added by {{ $supplier->company_name }}</h1>

    @if($items->isEmpty())
        <p>No items added yet.</p>
    @else
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Unit Price</th>
                <th>Quantity</th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $item)
                <tr>
                    <td>{{ $item->item_name }}</td>
                    <td>{{ $item->item_description }}</td>
                    <td>${{ number_format($item->unit_price, 2) }}</td>
                    <td>{{ $item->pivot->quantity }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('supplier-items.index') }}" class="btn btn-primary mt-3">Back to Available Items</a>
</div>
</body>
</html>
