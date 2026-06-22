<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Login | Complaint Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary-dark: #1A3A3F;
            --primary: #2C6E5C;
            --primary-light: #EAF6F2;
            --gray-50: #F8FAFC;
            --gray-100: #F1F5F9;
            --gray-200: #E9EDF2;
            --gray-300: #DFE5EA;
            --gray-400: #C2CDD6;
            --gray-500: #94A3B8;
            --gray-600: #64748B;
            --gray-700: #475569;
            --gray-800: #1E293B;
            --red-soft: #FEF2F2;
            --red: #DC2626;
            --green-soft: #ECFDF5;
            --green: #059669;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.05);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.08);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1);
            --radius-md: 10px;
            --radius-lg: 16px;
            --radius-xl: 24px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #eef5f9 0%, #d9e4ec 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        /* ===== MAIN CONTAINER ===== */
        .login-wrapper {
            display: flex;
            max-width: 1000px;
            width: 100%;
            background: white;
            border-radius: var(--radius-sm);
            box-shadow: var(--shadow-xl);
            overflow: hidden;
            min-height: 600px;
        }

        /* ===== LEFT PANEL ===== */
        .login-left {
            flex: 1.2;
            background: linear-gradient(145deg, var(--primary-dark) 0%, #0f2c38 100%);
            padding: 48px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .login-left::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle at 70% 30%, rgba(44, 122, 94, 0.15) 0%, transparent 70%);
            pointer-events: none;
        }

        .login-left .brand {
            position: relative;
            z-index: 1;
        }

        .login-left .brand img {
            max-width: 180px;
            margin-bottom: 24px;
            filter: brightness(0) invert(1);
        }

        .login-left .brand h1 {
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: -0.5px;
            margin-bottom: 8px;
        }

        .login-left .brand p {
            font-size: 0.9rem;
            opacity: 0.8;
            line-height: 1.6;
            max-width: 320px;
        }

        .login-left .features {
            margin-top: 40px;
            position: relative;
            z-index: 1;
        }

        .login-left .feature-item {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 16px;
            font-size: 0.85rem;
            opacity: 0.9;
        }

        .login-left .feature-item i {
            width: 36px;
            height: 36px;
            background: rgba(255, 255, 255, 0.12);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            color: #5fbc9a;
        }

        .login-left .feature-item span {
            font-weight: 400;
        }

        /* ===== RIGHT PANEL ===== */
        .login-right {
            flex: 1;
            padding: 48px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: white;
        }

        .login-right .header-text {
            margin-bottom: 32px;
        }

        .login-right .header-text h2 {
            font-size: 1.6rem;
            font-weight: 600;
            color: var(--gray-800);
            letter-spacing: -0.3px;
        }

        .login-right .header-text p {
            color: var(--gray-500);
            font-size: 0.9rem;
            margin-top: 4px;
        }

        /* ===== ERROR MESSAGE ===== */
        .error-message {
            background: var(--red-soft);
            border-left: 4px solid var(--red);
            padding: 12px 16px;
            border-radius: var(--radius-md);
            margin-bottom: 20px;
            font-size: 0.8rem;
            color: var(--red);
            display: none;
            align-items: center;
            gap: 10px;
        }

        .error-message.show {
            display: flex;
        }

        .error-message i {
            font-size: 1rem;
        }

        /* ===== FORM GROUP ===== */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--gray-600);
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-wrapper .input-icon {
            position: absolute;
            left: 14px;
            color: var(--gray-400);
            font-size: 0.95rem;
            pointer-events: none;
            transition: color 0.2s;
        }

        .input-wrapper input {
            width: 100%;
            padding: 14px 16px 14px 46px;
            border: 1.5px solid var(--gray-200);
            border-radius: var(--radius-md);
            font-size: 0.9rem;
            background: var(--gray-50);
            transition: all 0.2s;
            outline: none;
            font-family: inherit;
            color: var(--gray-800);
        }

        .input-wrapper input:focus {
            border-color: var(--primary);
            background: white;
            box-shadow: 0 0 0 3px rgba(44, 110, 92, 0.08);
        }

        .input-wrapper input:focus + .input-icon {
            color: var(--primary);
        }

        .input-wrapper input::placeholder {
            color: var(--gray-400);
            font-weight: 400;
        }

        /* ===== OPTIONS ROW ===== */
        .options-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px 0 28px;
            font-size: 0.8rem;
            flex-wrap: wrap;
            gap: 12px;
        }

        .checkbox {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--gray-600);
            cursor: pointer;
        }

        .checkbox input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: var(--primary);
            cursor: pointer;
        }

        .forgot-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        .forgot-link:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        /* ===== LOGIN BUTTON ===== */
        .login-btn {
            width: 100%;
            background: var(--primary);
            border: none;
            padding: 14px;
            border-radius: var(--radius-md);
            color: white;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-family: inherit;
            box-shadow: 0 4px 12px rgba(44, 110, 92, 0.25);
        }

        .login-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(44, 110, 92, 0.3);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .login-btn i {
            font-size: 0.9rem;
        }

        /* ===== REGISTER LINK ===== */
        .register-link {
            text-align: center;
            margin-top: 20px;
            font-size: 0.85rem;
            color: var(--gray-600);
        }

        .register-link a {
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
            transition: color 0.2s;
        }

        .register-link a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        /* ===== FOOTER ===== */
        .login-footer {
            margin-top: 24px;
            text-align: center;
            font-size: 0.7rem;
            color: var(--gray-400);
            border-top: 1px solid var(--gray-200);
            padding-top: 16px;
        }

        .login-footer i {
            margin-right: 6px;
        }

        /* ===== SUCCESS ALERT OVERRIDE ===== */
        .alert-success {
            background: var(--green-soft);
            border: 1px solid var(--green);
            color: var(--green);
            padding: 12px 16px;
            border-radius: var(--radius-md);
            margin-bottom: 20px;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success i {
            font-size: 1rem;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 820px) {
            body {
                align-items: flex-start;
                min-height: 100dvh;
            }

            .login-wrapper {
                flex-direction: column;
                max-width: 480px;
                width: 100%;
                min-height: auto;
            }

            .login-left {
                padding: 32px 28px;
                text-align: center;
            }

            .login-left .brand p {
                max-width: 100%;
            }

            .login-left .features {
                display: none;
            }

            .login-right {
                padding: 32px 28px;
            }

            .login-left .brand img {
                max-width: 140px;
            }
        }

        @media (max-width: 420px) {
            .login-right {
                padding: 24px 20px;
            }

            .login-left {
                padding: 24px 20px;
            }

            .options-row {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        /* Enhanced Responsive Design */
        
        /* Extra Small (< 480px) */
        @media (max-width: 479px) {
            body {
                padding: 12px;
            }

            .login-wrapper {
                width: 100%;
                min-height: auto;
                border-radius: 12px;
            }

            .login-left {
                padding: 20px 16px;
                min-height: auto;
            }

            .login-left .brand h1 {
                font-size: 1.5rem;
                margin-bottom: 12px;
            }

            .login-left .brand p {
                font-size: 0.85rem;
            }

            .login-right {
                padding: 20px 16px;
            }

            .form-group input,
            .form-group select {
                font-size: 16px; /* Prevents zoom on iOS */
            }

            .login-btn {
                font-size: 0.95rem;
            }

            .login-footer {
                font-size: 0.8rem;
            }

            .options-row {
                flex-direction: column;
                align-items: stretch;
                gap: 12px;
            }

            .options-row label {
                font-size: 0.85rem;
            }

            .forgot-link {
                width: 100%;
                text-align: left;
            }

            .remember-link {
                font-size: 0.8rem;
            }
        }

        /* Small Tablets (480px - 767px) */
        @media (min-width: 480px) and (max-width: 767px) {
            body {
                padding: 16px;
            }

            .login-wrapper {
                min-height: auto;
            }

            .login-left {
                padding: 28px 24px;
            }

            .login-right {
                padding: 28px 24px;
            }

            .login-left .brand h1 {
                font-size: 1.75rem;
            }

            .login-left .brand p {
                font-size: 0.9rem;
            }
        }

        /* Tablets (768px - 991px) */
        @media (min-width: 768px) and (max-width: 991px) {
            .login-wrapper {
                max-width: 600px;
            }

            .login-left {
                flex: 1;
            }

            .login-left .brand h1 {
                font-size: 2rem;
            }

            .login-left .features {
                display: block;
                margin-top: 24px;
            }
        }

        /* Medium to Large (992px and above) */
        @media (min-width: 992px) {
            .login-wrapper {
                max-width: 1000px;
            }

            .login-left .brand h1 {
                font-size: 2.2rem;
            }

            .form-group input,
            .form-group select {
                font-size: 0.95rem;
            }
        }

        /* Print Styles */
        @media print {
            .login-wrapper,
            .login-footer {
                display: none;
            }
        }

        /* Accessibility */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        /* Dark Mode Support */
        @media (prefers-color-scheme: dark) {
            body {
                background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            }

            .login-wrapper {
                background: #2a2a3e;
                color: #e0e0e0;
            }

            .login-right {
                background: #2a2a3e;
            }

            .form-group input,
            .form-group select {
                background: #3a3a4e;
                color: #e0e0e0;
                border-color: #555;
            }

            .form-group label {
                color: #d0d0d0;
            }
        }
    </style>
</head>
<body>

<div class="login-wrapper">
    <!-- ===== LEFT PANEL ===== -->
    <div class="login-left">
        <div class="brand">
            <img src="{{ asset('uploads/merchant9-logo.png') }}" alt="Merchant9 Logo">
            <h1>Welcome Back</h1>
            <p>Sign in to access the Complaint Management System and manage your tickets efficiently.</p>
        </div>

        <div class="features">
            <div class="feature-item">
                <i class="fas fa-ticket-alt"></i>
                <span>Submit and track complaints</span>
            </div>
            <div class="feature-item">
                <i class="fas fa-chart-line"></i>
                <span>Real-time status updates</span>
            </div>
            <div class="feature-item">
                <i class="fas fa-shield-alt"></i>
                <span>Secure & encrypted access</span>
            </div>
        </div>
    </div>

    <!-- ===== RIGHT PANEL ===== -->
    <div class="login-right">
        <div class="header-text">
            <h2>Sign In</h2>
            <p>Enter your credentials to access your account</p>
        </div>

        <!-- Success Message -->
        @if(session('success'))
        <div class="alert-success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Field -->
            <div class="form-group">
                <label for="email">Email Address</label>
                <div class="input-wrapper">
                    <i class="fas fa-envelope input-icon"></i>
                    <input type="email" id="email" name="employeeEmail" placeholder="employee@complaint.com" value="{{ old('employeeEmail') }}" required autofocus>
                </div>
            </div>

            <!-- Password Field -->
            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-wrapper">
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
            </div>

            <!-- Options Row -->
            <div class="options-row">
                <label class="checkbox">
                    <input type="checkbox" name="remember" id="rememberCheck" {{ old('remember') ? 'checked' : '' }}>
                    <span>Remember me</span>
                </label>
                <a href="#" class="forgot-link" id="forgotPasswordLink">Forgot password?</a>
            </div>

            <!-- Login Button -->
            <button type="submit" class="login-btn">
                <i class="fas fa-sign-in-alt"></i> Sign In
            </button>
        </form>

        <!-- Register Link -->
        <!-- <div class="register-link">
            Don't have an account?
            <a href="{{ route('clerk.register.employee') }}">Register here</a>
        </div> -->

        <div class="login-footer">
            <i class="fas fa-shield-alt"></i> Secure employee portal &bull; Merchant9 CMS
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@include('partials.responsive-overrides')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // ===== FORGOT PASSWORD =====
        document.getElementById('forgotPasswordLink')?.addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Reset Password',
                text: 'Please contact your system administrator to reset your password.',
                icon: 'info',
                confirmButtonColor: '#2C6E5C',
                confirmButtonText: 'OK',
                borderRadius: '16px'
            });
        });

        // ===== AUTO-FOCUS ON EMAIL =====
        const emailInput = document.getElementById('email');
        if (emailInput) {
            emailInput.focus();
        }

        // ===== SUCCESS AUTO-CLOSE =====
        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Logged Out',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 1800,
            borderRadius: '16px'
        });
        @endif

        // ===== LOGIN FAILED =====
        @if(session('login_error'))
        Swal.fire({
            icon: 'error',
            title: 'Login Failed',
            text: '{{ session('login_error') }}',
            confirmButtonColor: '#DC2626',
            borderRadius: '16px'
        });
        @endif

        // ===== HIDE ERROR ON INPUT =====
        const inputs = document.querySelectorAll('.input-wrapper input');
        const errorBox = document.querySelector('.error-message');
        if (errorBox) {
            inputs.forEach(input => {
                input.addEventListener('input', function() {
                    errorBox.classList.remove('show');
                });
            });
        }
    });
</script>

</body>
</html>
