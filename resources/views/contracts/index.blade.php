<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contract List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Contract List</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif



    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Supplier Name</th>
            <th>User</th>
            <th>Contract number</th>
        </tr>
        </thead>
        <tbody>
        @foreach($contracts as $contract)
            <tr>
                <td>{{ $contract->supplier->company_name }}</td>
                <td>{{ $contract->user->name }}</td>
                <td>{{ $contract->contract_number }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>


</div>
</body>
</html>
