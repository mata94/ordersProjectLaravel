<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { height: 100vh; display: flex; justify-content: center; align-items: center; background-color: #f8f9fa; }
        .login-container { max-width: 400px; width: 100%; padding: 20px; background: #ffffff; border-radius: 10px; box-shadow: 0 0 20px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
<div class="container login-container">
    <h2 class="text-center mb-4">Login</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
            @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex flex-column align-items-center">
            <button type="submit" class="btn btn-primary mb-3">Login</button>
            <a href="{{ route('register') }}" class="text-decoration-none">Nemate račun? Registriraj se</a>
        </div>
        <a href="{{ url('/auth/google') }}" class="btn btn-outline-danger w-100 mt-3 d-flex align-items-center justify-content-center" style="border-radius: 5px;">
            <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" width="20" height="20" class="me-2">
            Prijavi se preko Google-a
        </a>

    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
