<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/admin/login/style.css') }}">
    <title>Admin</title>
</head>
<body>
<div class="box">
    <span class="borderLine"></span>
    <form action="{{ route('admin.login.post') }}" method="post">
        @csrf
        <h2>Sign in</h2>
        <div class="inputBox">
            <label>
                <input type="text" required="required" name="login" placeholder="Login">
            </label>
            <i></i>
        </div>
        <div class="inputBox">
            <label>
                <input type="password" required="required" name="password" placeholder="Password">
            </label>
            <i></i>
        </div>
        <div class="links">
            <a href="/">Home</a>
        </div>
        <input type="submit" value="Login">
    </form>
</div>
@if ($errors->any())
    <div class="error-block">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
</body>
</html>
