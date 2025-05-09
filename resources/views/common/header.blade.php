<nav class="navbar navbar-expand-lg navbar-light mb-5" style="background-color: gray;">
    <div class="container-fluid">
        <a class="navbar-brand" style="color: white;" href="#">Order and  Suppliers</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav" style="justify-content: right;">
            <ul class="navbar-nav">
                @if(auth()->user() && auth()->user()->role == \App\Models\User::ROLE_ADMIN)
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('admin.users.index')}}">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('admin.suppliers')}}">Suppliers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('admin.items')}}">Items</a>
                    </li>
                @endif

                @if(auth()->user() && auth()->user()->role == \App\Models\User::ROLE_SUPPLIER)
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('supplier.available-items')}}">Available items</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('supplier-items.show')}}">My Items</a>
                    </li>
                @endif

                @if(auth()->user() && auth()->user()->role == \App\Models\User::ROLE_WORKER)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('worker.suppliers.index') }}">Suppliers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('worker.contract.myContracts') }}">My Contracts</a>
                    </li>
                @endif

                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    .nav-link{
        color:white!important;
    }
</style>
