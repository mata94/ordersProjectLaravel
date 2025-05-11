<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Contracts List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="display: block">
@include('common.header')
<div class="container mt-5">
    <h1 class="mb-4">All Contracts</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Contract Number</th>
            <th>Supplier Company Name</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Total Value</th>
            <th>User</th>
            <th>Status</th>
            <th>Singed By</th>
            <th>Singed At</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($contracts as $contract)
            <tr>
                <td>{{ $contract->contract_number }}</td>
                <td>{{ $contract->supplier->company_name }}</td>
                <td>{{ $contract->start_date ? $contract->start_date->format('Y-m-d') : 'N/A' }}</td>
                <td>{{ $contract->end_date ? $contract->end_date->format('Y-m-d') : 'N/A' }}</td>
                <td>{{ number_format($contract->total_value, 2) }}</td>
                <td>{{ $contract->user->name ?? 'Unknown User' }}</td>
                <td>{{ $contract->status }}</td>
                <td>{{ $contract->approver->name }}</td>
                <td>{{ $contract->approved_at->format('Y-m-d')}}</td>
                <td class="d-flex gap-1">
                    <a href="{{ route('director.contractItems', $contract->id) }}" class="btn btn-warning btn-sm">
                        View Items
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>
</body>
</html>
