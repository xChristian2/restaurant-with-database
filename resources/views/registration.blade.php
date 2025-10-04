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
.register-container {
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
    transition: background-color 0.4s ease, color 0.4s ease, border-color 0.4s ease;
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
#passwordHelp {
    font-size: 0.85rem;
    color: #ff4d4f;
    display: none;
}
#passwordHelp.valid {
    color: #4caf50;
}
#matchMsg { font-size: 0.85rem; }
#matchMsg.mismatch { color: #ff4d4f; }
#matchMsg.match { color: #4caf50; }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

<div class="fade-in-page">
    <div class="register-container">
        <h2 class="text-center">Register</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('/registration') }}" method="POST" id="registerForm">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label" style="color:#d4af37;">Name</label>

                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label" style="color:#d4af37;">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
            </div>

            <div class="mb-3 password-wrapper">
    <label for="password" class="form-label" style="color:#d4af37;">Password</label>
    <div style="position: relative;"> <!-- relative wrapper -->
        <input type="password" name="password" id="password" class="form-control" required minlength="8" maxlength="32" style="padding-right: 45px;">
        <span class="password-toggle" onclick="togglePassword('password','togglePasswordIcon1')">
            <i class="fa-solid fa-eye" id="togglePasswordIcon1"></i>
        </span>
    </div>
    <small id="passwordHelp">Password must contain: lowercase, uppercase, number, special character</small>
</div>

<div class="mb-3 password-wrapper">
    <label for="password_confirmation" class="form-label" style="color:#d4af37;">Confirm Password</label>
    <div style="position: relative;"> <!-- same wrapper for alignment -->
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required minlength="8" maxlength="32" style="padding-right: 45px;">
        <span class="password-toggle" onclick="togglePassword('password_confirmation','togglePasswordIcon2')">
            <i class="fa-solid fa-eye" id="togglePasswordIcon2"></i>
        </span>
    </div>
    <small id="matchMsg"></small>
</div>


            <button type="submit" class="btn btn-gold w-100">Register</button>
        </form>

        <p class="text-center mt-3 text-white">
            Already have an account? 
            <a href="{{ url('/login') }}" style="color:#d4af37;">Login here</a>
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

// Live password requirements
const password = document.getElementById('password');
const passwordHelp = document.getElementById('passwordHelp');
password.addEventListener('input', () => {
    const val = password.value;
    const pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])/;
    if(pattern.test(val)){
        passwordHelp.textContent = 'Password meets all requirements';
        passwordHelp.classList.add('valid');
        passwordHelp.style.display = 'inline';
        setTimeout(()=>{ passwordHelp.style.display='none'; }, 2000);
    } else {
        passwordHelp.textContent = 'Password must contain: lowercase, uppercase, number, special character';
        passwordHelp.classList.remove('valid');
        passwordHelp.style.display = 'inline';
    }
});

// Password match live checker
const confirm = document.getElementById('password_confirmation');
const matchMsg = document.getElementById('matchMsg');
confirm.addEventListener('input', () => {
    if(confirm.value === password.value){
        matchMsg.textContent = 'Passwords match';
        matchMsg.classList.remove('mismatch');
        matchMsg.classList.add('match');
        confirm.style.borderColor = '#4caf50';
    } else {
        matchMsg.textContent = 'Passwords do not match';
        matchMsg.classList.remove('match');
        matchMsg.classList.add('mismatch');
        confirm.style.borderColor = '#ff4d4f';
    }
});
</script>
@endsection
