<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/all.css">

    <style>
        body {
            background: #f4f6f9;
        }
        .login-box {
            max-width: 420px;
            margin: 100px auto;
            padding: 30px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.08);
        }
    </style>
</head>

<body>

<div class="login-box">
    <h4 class="text-center mb-4">
        <i class="fa-solid fa-user-shield"></i> Admin Login
    </h4>

    {{-- ✅ NORMAL FORM SUBMIT --}}
    <form method="POST" action="{{ route('admin.login.submit') }}">
        @csrf

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-dark w-100">
            Login
        </button>
    </form>

    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            {{ $errors->first() }}
        </div>
    @endif
</div>

</body>
</html>
