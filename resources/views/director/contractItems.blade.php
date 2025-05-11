<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contract Items</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="display: block">
@include('common.header')
<div class="container mt-5">
    <h1 class="mb-4">Contract items</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Item Name</th>
            <th>Description</th>
            <th>Quantity</th>
            <th>Price per unit</th>
        </tr>
        </thead>
        <tbody>

        @foreach($contractItems as $contractItem)
            <tr>
                <td>{{ $contractItem->item->item_name }}</td>
                <td>{{ $contractItem->item->item_description }}</td>
                <td>{{ $contractItem->quantity }}</td>
                <td>{{ $contractItem->price_per_unit}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
