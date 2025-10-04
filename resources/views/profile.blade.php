<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Profile</title>
    <style>
        /* --- Reset & Body --- */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f8fafc;
            color: #334155;
            line-height: 1.6;
        }

        /* --- Profile Container --- */
        .profile-container {
            max-width: 800px;
            margin: 2rem auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .profile-header {
            background: linear-gradient(135deg,#ea580c,#f97316);
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .profile-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            margin: 0 auto 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
        }

        .profile-name {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .profile-role {
            opacity: 0.9;
            font-size: 0.9rem;
        }

        /* --- Tabs --- */
        .tab-navigation {
            display: flex;
            background: #f1f5f9;
            border-bottom: 1px solid #e2e8f0;
        }

        .tab-button {
            flex: 1;
            padding: 1rem;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 500;
            color: #64748b;
            transition: all 0.2s;
            border-bottom: 3px solid transparent;
        }

        .tab-button:hover {
            background: #e2e8f0;
            color: #334155;
        }

        .tab-button.active {
            background: white;
            color: #ea580c;
            border-bottom-color: #ea580c;
        }

        .tab-content {
            padding: 2rem;
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        /* --- Forms --- */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #374151;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 0.9rem;
            transition: border-color 0.2s;
        }

        .form-input:focus {
            outline: none;
            border-color: #ea580c;
            box-shadow: 0 0 0 3px rgba(234,88,12,0.1);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        /* --- Buttons --- */
        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 6px;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-primary {
            background: #ea580c;
            color: white;
        }

        .btn-primary:hover {
            background: #dc2626;
        }

        .btn-secondary {
            background: #6b7280;
            color: white;
        }

        .btn-secondary:hover {
            background: #4b5563;
        }

        .btn-danger {
            background: #dc2626;
            color: white;
        }

        .btn-danger:hover {
            background: #b91c1c;
        }

        /* --- Info Items --- */
        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-label {
            font-weight: 500;
            color: #374151;
        }

        .info-value {
            color: #6b7280;
        }

        /* --- Logout --- */
        .logout-section {
            text-align: center;
            padding: 2rem;
            background: #fef2f2;
            border-radius: 8px;
            margin-top: 1rem;
        }

        .logout-warning {
            color: #991b1b;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        /* --- Toast --- */
        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 1rem 1.5rem;
            background: #10b981;
            color: white;
            border-radius: 6px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
            transform: translateX(400px);
            transition: transform 0.3s;
            z-index: 1000;
        }

        .toast.show {
            transform: translateX(0);
        }

        .toast.error {
            background: #dc2626;
        }

        /* --- Responsive --- */
        @media (max-width: 768px) {
            .profile-container {
                margin: 1rem;
                border-radius: 8px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .tab-button {
                font-size: 0.8rem;
                padding: 0.75rem 0.5rem;
            }
        }
    </style>
</head>
<body>
<div class="profile-container">
    <!-- Profile Header -->
    <div class="profile-header">
        <div class="profile-avatar">👨‍🍳</div>
        <div class="profile-name">{{ Auth::user()->name }}</div>
        <div class="profile-role">Restaurant Manager</div>
    </div>
    

    <!-- Tab Navigation -->
    <div class="tab-navigation">
        <button class="tab-button active" onclick="showTab('profile')">Profile</button>
        <button class="tab-button" onclick="showTab('contact')">Contact Info</button>
        <button class="tab-button" onclick="showTab('password')">Change Password</button>
        <button class="tab-button" onclick="showTab('logout')">Logout</button>
    </div>

    <!-- Profile Tab -->
    <div id="profile-tab" class="tab-content active">
        <h3>Personal Information</h3>
        <form id="profile-form">
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">First Name</label>
                    <input type="text" class="form-input" id="firstName" value="{{ Auth::user()->first_name }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Last Name</label>
                    <input type="text" class="form-input" id="lastName" value="{{ Auth::user()->last_name }}">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Email Address</label>
                <input type="email" class="form-input" id="email" value="{{ Auth::user()->email }}">
            </div>
            <div class="form-row" style="justify-content: space-between; align-items: center;">
    <button type="submit" class="btn btn-primary">Update Profile</button>
    <a href="{{ route('home') }}" class="btn btn-secondary" style="background: #f1f5f9; color: #64748b;">Home</a>
</div>
        </form>
    </div>

    <!-- Contact Info Tab -->
    <div id="contact-tab" class="tab-content">
        <h3>Contact Information</h3>
        <form id="contact-form">
            <div class="info-item">
                <span class="info-label">Phone Number</span>
                <input type="text" class="form-input" name="phone" value="{{ Auth::user()->phone }}">
            </div>
            <div class="info-item">
                <span class="info-label">Work Email</span>
                <input type="email" class="form-input" name="work_email" value="{{ Auth::user()->work_email }}">
            </div>
            <div class="info-item">
                <span class="info-label">Personal Email</span>
                <input type="email" class="form-input" name="personal_email" value="{{ Auth::user()->personal_email }}">
            </div>
            <div class="info-item">
                <span class="info-label">Address</span>
                <input type="text" class="form-input" name="address" value="{{ Auth::user()->address }}">
            </div>
            <div class="info-item">
                <span class="info-label">Emergency Contact</span>
                <input type="text" class="form-input" name="emergency_contact" value="{{ Auth::user()->emergency_contact }}">
            </div>
            <div style="margin-top:1rem;">
                <button type="submit" class="btn btn-primary">Save Contact Info</button>
            </div>
        </form>
    </div>

    <!-- Password Tab -->
    <div id="password-tab" class="tab-content">
        <h3>Change Password</h3>
        <form id="password-form">
            <div class="form-group">
                <label class="form-label">Current Password</label>
                <input type="password" class="form-input" id="currentPassword" required>
            </div>
            <div class="form-group">
                <label class="form-label">New Password</label>
                <input type="password" class="form-input" id="newPassword" required>
            </div>
            <div class="form-group">
                <label class="form-label">Confirm New Password</label>
                <input type="password" class="form-input" id="confirmPassword" required>
            </div>
            <button type="submit" class="btn btn-primary" style="margin-top:1rem;">Change Password</button>
        </form>
    </div>

    <!-- Logout Tab -->
    <div id="logout-tab" class="tab-content">
        <h3>Logout</h3>
        <div class="logout-section">
            <div class="logout-warning">
                ⚠️ You are about to logout from your account.
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to logout?');">Logout Now</button>
            </form>
        </div>
    </div>

</div>

<div id="toast" class="toast"></div>

<script>
    // Tab switching
    function showTab(tabName) {
        document.querySelectorAll('.tab-content').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.tab-button').forEach(b => b.classList.remove('active'));
        document.getElementById(tabName + '-tab').classList.add('active');
        event.target.classList.add('active');
    }

    // Toast notification
    function showToast(message, isError=false) {
        const toast = document.getElementById('toast');
        toast.textContent = message;
        toast.className = 'toast show' + (isError ? ' error' : '');
        setTimeout(() => { toast.classList.remove('show'); }, 3000);
    }

    // Profile form
    document.getElementById('profile-form').addEventListener('submit', function(e) {
        e.preventDefault();
        showToast('Profile updated!');
    });

    // Contact form
    document.getElementById('contact-form').addEventListener('submit', function(e) {
        e.preventDefault();
        showToast('Contact info saved!');
    });

    // Password form
    document.getElementById('password-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const newPass = document.getElementById('newPassword').value;
        const confirmPass = document.getElementById('confirmPassword').value;
        if (newPass !== confirmPass) {
            showToast('Passwords do not match!', true);
            return;
        }
        showToast('Password changed!');
        this.reset();
    });
</script>
</body>
</html>
