<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $supplier->company_name }} - Added Items</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="display: block">
@include('common.header')
<div class="container mt-5">
    <h1 class="mb-4">Items Added by {{ $supplier->company_name }}</h1>
    @if($supplierItems->isEmpty())
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
            @foreach($supplierItems as $supplierItem)
                <tr>
                    <td>{{ $supplierItem->item->item_name }}</td>
                    <td>{{ $supplierItem->item->item_description }}</td>
                    <td>${{ number_format($supplierItem->price_per_unit, 2) }}</td>
                    <td>{{ $supplierItem->quantity }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>
</body>
</html>
