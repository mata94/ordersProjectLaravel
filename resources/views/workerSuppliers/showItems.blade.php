<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Items</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Supplier Items</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Item Name</th>
            <th>Item Description</th>
            <th>Item Price</th>
        </tr>
        </thead>
        <tbody>
        @foreach($supplierItems as $supplierItem)
            <tr>
                <td>{{ $supplierItem->item->item_name }}</td>
                <td>{{ $supplierItem->item->item_description }}</td>
                <td>{{ $supplierItem->item->unit_price }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>
</body>
</html>
