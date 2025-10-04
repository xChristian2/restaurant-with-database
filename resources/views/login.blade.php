@extends('layouts.app')

@section('content')
<style>
    .fade-in-page {
        opacity: 0;
        animation: fadeIn 1s forwards;
    }
    @keyframes fadeIn {
        to { opacity: 1; }
    }
    body {
        background: linear-gradient(to bottom right, #1b1b1b, #2c2c2c);
    }
    .login-container {
        max-width: 400px;
        margin: 80px auto;
        padding: 40px;
        background: rgba(0,0,0,0.7);
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(212,175,55,0.4);
    }
    h2 { color: #d4af37; margin-bottom: 30px; }
    .form-control {
        background: #1b1b1b;
        color: #fff;
        border: 1px solid #d4af37;
        border-radius: 8px;
        padding-right: 45px;
        transition: background-color 0.4s ease, color 0.4s ease;
    }
    .form-control:focus {
        background-color: white;
        color: #1b1b1b;
        outline: none;
        box-shadow: 0 0 10px rgba(212, 175, 55, 0.5);
        border-color: #f9d67a;
    }
    .btn-gold {
        background: #d4af37;
        color: #1b1b1b;
        font-weight: bold;
        border-radius: 25px;
        padding: 12px 0;
        font-size: 1.1rem;
        transition: all 0.3s ease;
    }
    .btn-gold:hover { background: #f9d67a; }
    .password-wrapper { position: relative; }
    .password-toggle {
        position: absolute;
        top: 50%;
        right: 15px;
        transform: translateY(-50%);
        cursor: pointer;
        color: #d4af37;
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

<div class="fade-in-page">
    <div class="login-container">
        <h2 class="text-center">Login</h2>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ url('/login') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label" style="color:#d4af37;">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
            </div>

            <div class="mb-3 password-wrapper">
                <label for="password" class="form-label" style="color:#d4af37;">Password</label>
                <div style="position: relative;">
                    <input type="password" name="password" id="password" class="form-control" required maxlength="32" style="padding-right: 45px;">
                    <span class="password-toggle" onclick="togglePassword('password','togglePasswordIcon')" style="position:absolute; top:50%; right:15px; transform:translateY(-50%); cursor:pointer;">
                        <i class="fa-solid fa-eye" id="togglePasswordIcon"></i>
                    </span>
                </div>
            </div>

            <button type="submit" class="btn btn-gold w-100">Login</button>
        </form>

        <p class="text-center mt-3 text-white">
            Don't have an account? 
            <a href="{{ url('/registration') }}" style="color:#d4af37;">Register here</a>
        </p>
    </div>
</div>

<script>
function togglePassword(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);
    if(input.type === "password"){
        input.type = "text";
        icon.classList.replace('fa-eye','fa-eye-slash');
    } else {
        input.type = "password";
        icon.classList.replace('fa-eye-slash','fa-eye');
    }
}
</script>
@endsection
