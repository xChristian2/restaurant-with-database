@extends('layouts.app')

@section('content')
<style>
.fade-in-page {
    opacity: 0;
    animation: fadeIn 1s forwards;
}
@keyframes fadeIn { to { opacity: 1; } }

body {
    background: linear-gradient(to bottom right, #1b1b1b, #2c2c2c);
}

.reservation-container {
    min-height: 80vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 60px 0;
}

.reservation-card {
    background: rgba(27,27,27,0.9);
    border: 2px solid #d4af37;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(212,175,55,0.4);
    padding: 30px;
    width: 100%;
    max-width: 600px;
    transition: transform 0.4s ease, box-shadow 0.4s ease;
}

.reservation-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(212,175,55,0.6);
}

.reservation-card h2 {
    color: #d4af37;
    text-align: center;
    margin-bottom: 30px;
}

.form-label { color: #fff; font-weight: 500; }

.form-control {
    background: #1b1b1b;
    color: #fff;
    border: 1px solid #d4af37;
    border-radius: 10px;
    padding: 12px 15px;
    width: 100%;
    box-sizing: border-box;
    transition: all 0.3s ease;
}

.form-control:focus {
    background: #fff;
    color: #1b1b1b;
    outline: none;
    box-shadow: 0 0 10px rgba(212,175,55,0.5);
    border-color: #f9d67a;
}

/* Style native picker */
input[type="date"],
input[type="time"] {
    accent-color: #d4af37; /* makes the picker buttons gold */
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

.btn-gold:hover {
    background: #f9d67a;
    color: #000;
    transform: scale(1.05);
    box-shadow: 0 5px 15px rgba(212,175,55,0.5);
}
</style>

<div class="fade-in-page">
    <div class="reservation-container">
        <div class="reservation-card">
            <h2>Make a Reservation</h2>
            <form id="reservationForm" action="{{ url('/reservation') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="res_name" class="form-label">Name</label>
                    <input type="text" name="name" id="res_name" class="form-control"
                           value="{{ auth()->user()->name ?? '' }}" @guest required @endguest>
                </div>

                <div class="mb-3">
                    <label for="res_date" class="form-label">Date</label>
                    <input type="date" name="date" id="res_date" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="res_time" class="form-label">Time</label>
                    <input type="time" name="time" id="res_time" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="res_people" class="form-label">Number of Guests</label>
                    <input type="number" name="people" id="res_people" class="form-control" required min="1">
                </div>

                <button type="submit" class="btn btn-gold w-100">Confirm Reservation</button>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('reservationForm').addEventListener('submit', function(e) {
    e.preventDefault(); // prevent default form submission for validation

    const dateInput = document.getElementById('res_date').value;
    const selectedDate = new Date(dateInput);
    const minDate = new Date('2025-01-01');
    const maxDate = new Date('2025-12-31');

    if(selectedDate < minDate || selectedDate > maxDate) {
        alert('Please enter a valid date (only 2025 is allowed).');
        return;
    }

    // If everything is okay
    alert('Reservation success!');
    window.location.href = '/'; // redirect to homepage
});
</script>
@endsection
