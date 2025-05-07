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
    <h1 class="mb-4">Contract with {{ $supplier->company_name }}</h1>

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
            <th>Total Items</th>
            <th>Item Price</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($supplierItems as $supplierItem)
            <tr>
                <td>{{ $supplierItem->item->item_name }}</td>
                <td>{{ $supplierItem->item->item_description }}</td>
                <td>{{ $supplierItem->quantity }}</td>
                <td>{{ $supplierItem->item->unit_price }}</td>
                <td>
                    <form method="POST" action="{{ route('contract.addItem', ['contractId' => $contract->id]) }}">
                        @csrf
                        <div style="display:flex;">
                            <div style="display:block;">
                                <label>Quantity</label>
                                <input type="hidden" name="item_id" value="{{ $supplierItem->item->id }}">
                            </div>
                            <input type="number" name="quantity" value="1" min="1" class="form-control mb-1" style="width: 80px;">
                            <button type="submit" class="btn btn-primary btn-sm">Add</button>
                        </div>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <h3 class="mt-5">Added Items</h3>

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
    <div>
        <form action="{{ route('contract.finish', ['id' => $contract->id]) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success">Finish Contract</button>
        </form>
    </div>
</div>
</body>
</html>
