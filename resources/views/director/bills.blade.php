<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bills</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="display: block">
@include('common.header')
<div class="container mt-5">
    <h1 class="mb-4 d-flex justify-content-between align-items-center">
        <span>Bills</span>
        @if($bills->isNotEmpty())
            <a href="{{ route('director.bills.export') }}" class="btn btn-success">Export to Excel</a>
        @endif
    </h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Supplier Name</th>
            <th>Contract Number</th>
            <th>Worker</th>
            <th>Amount</th>
        </tr>
        </thead>
        <tbody>

        @foreach($bills as $bill)
            <tr>
                <td>{{ $bill->supplier->company_name }}</td>
                <td>{{ $bill->contract->contract_number }}</td>
                <td>{{ $bill->createdBy->name }}</td>
                <td>{{ $bill->amount }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
