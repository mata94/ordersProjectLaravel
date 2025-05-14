<!-- resources/views/director/items.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Items</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
@include('common.header')
<div class="container mt-5">
    <h1 class="mb-4">Items for Contract #{{ $contract->contract_number }}</h1>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Item Name</th>
            <th>Description</th>
            <th>Quantity</th>
            <th>Price per Unit</th>
            <th>Total Price</th>
        </tr>
        </thead>
        <tbody>
        @foreach($contract->items as $item)
            <tr>
                <td>{{ $item->item_name }}</td>
                <td>{{ $item->item_description }}</td>
                <td>{{ $item->pivot->quantity }}</td>
                <td>{{ $item->pivot->price_per_unit }}</td>
                <td>{{ $item->pivot->quantity * $item->pivot->price_per_unit }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
