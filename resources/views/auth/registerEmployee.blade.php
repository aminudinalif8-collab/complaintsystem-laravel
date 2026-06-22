
<style>
    .register-container {
        max-width: 550px;
        margin: 0 auto;
        width: 100%;
    }
    .card {
        border: none;
        border-radius: 28px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }
    .card-header {
        background: linear-gradient(135deg, #1a3a48 0%, #2c7a5e 100%);
        color: white;
        font-size: 1.3rem;
        font-weight: 600;
        padding: 24px 28px;
        border: none;
    }
    .card-header i {
        margin-right: 10px;
    }
    .card-body {
        padding: 32px 28px;
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-label {
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #3a6f86;
        margin-bottom: 8px;
        display: block;
    }
    .form-control {
        width: 100%;
        padding: 12px 16px;
        border-radius: 16px;
        border: 1.5px solid #e2edf2;
        font-size: 0.9rem;
        transition: all 0.2s;
    }
    .form-control:focus {
        outline: none;
        border-color: #2c7a5e;
        box-shadow: 0 0 0 3px rgba(44, 122, 94, 0.1);
    }
    select.form-control {
        cursor: pointer;
        background-color: white;
    }
    .btn-register {
        background: linear-gradient(135deg, #2c7a5e 0%, #1e5e48 100%);
        color: white;
        border: none;
        padding: 14px 28px;
        border-radius: 40px;
        font-weight: 600;
        font-size: 0.95rem;
        width: 100%;
        cursor: pointer;
        transition: transform 0.2s;
        margin-top: 12px;
    }
    .btn-register:hover {
        transform: scale(0.98);
        background: linear-gradient(135deg, #1e5e48 0%, #154f3c 100%);
    }
    .btn-register i {
        margin-right: 8px;
    }
    .text-muted {
        font-size: 0.75rem;
        color: #8aa0ae;
        margin-top: 8px;
        text-align: center;
    }
    .offset-md-4 {
        margin-left: 0;
    }
    .row {
        margin-bottom: 16px;
    }
    @media (max-width: 768px) {
        .register-container {
            padding-left: 12px;
            padding-right: 12px;
        }

        .card {
            border-radius: 18px;
        }

        .card-header {
            padding: 20px;
            font-size: 1.1rem;
        }

        .card-body {
            padding: 24px 20px;
        }

        .form-control {
            font-size: 16px;
        }
    }

    @media (max-width: 480px) {
        .register-container {
            padding-left: 8px;
            padding-right: 8px;
        }

        .card {
            border-radius: 14px;
        }

        .card-header,
        .card-body {
            padding: 16px;
        }

        .btn-register {
            padding: 13px 18px;
            white-space: normal;
        }
    }
</style>

<div class="container register-container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-user-plus"></i> Employee Registration
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('clerk.register.employee.post') }}">
                        @csrf

                        <!-- Employee Name -->
                        <div class="form-group">
                            <label for="employeeName" class="form-label">
                                <i class="fas fa-user"></i> Full Name
                            </label>
                            <input id="employeeName" type="text" class="form-control @error('employeeName') is-invalid @enderror" 
                                   name="employeeName" value="{{ old('employeeName') }}" required autocomplete="name" autofocus
                                   placeholder="Enter your full name">
                            @error('employeeName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Employee Email -->
                        <div class="form-group">
                            <label for="employeeEmail" class="form-label">
                                <i class="fas fa-envelope"></i> Email Address
                            </label>
                            <input id="employeeEmail" type="email" class="form-control @error('employeeEmail') is-invalid @enderror" 
                                   name="employeeEmail" value="{{ old('employeeEmail') }}" required autocomplete="email"
                                   placeholder="employee@company.com">
                            @error('employeeEmail')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Employee Phone Number -->
                        <div class="form-group">
                            <label for="employeePhone" class="form-label">
                                <i class="fas fa-phone-alt"></i> Phone Number
                            </label>
                            <input id="employeePhone" type="tel" class="form-control @error('employeePhone') is-invalid @enderror" 
                                   name="employeePhone" value="{{ old('employeePhone') }}" required autocomplete="tel"
                                   placeholder="+60 12 345 6789">
                            @error('employeePhone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Department Dropdown -->
                        <div class="form-group">
                            <label for="departmentID" class="form-label">
                                <i class="fas fa-building"></i> Department
                            </label>

                            <select id="departmentID"
                                    class="form-control @error('departmentID') is-invalid @enderror"
                                    name="departmentID"
                                    required>

                                <option value="" disabled selected>— Select Department —</option>

                                @foreach($departments as $department)
                                    <option value="{{ $department->departmentID }}"
                                        {{ old('departmentID') == $department->departmentID ? 'selected' : '' }}>
                                        {{ $department->departmentName }}
                                    </option>
                                @endforeach

                            </select>

                            @error('departmentID')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="form-group">
                            <label for="employeePassword" class="form-label">
                                <i class="fas fa-lock"></i> Password
                            </label>
                            <input id="employeePassword" type="password" class="form-control @error('employeePassword') is-invalid @enderror" 
                                   name="employeePassword" required autocomplete="new-password"
                                   placeholder="Min. 8 characters">
                            @error('employeePassword')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-group">
                            <label for="password-confirm" class="form-label">
                                <i class="fas fa-check-circle"></i> Confirm Password
                            </label>
                            <input id="password-confirm" type="password" class="form-control" 
                                   name="employeePassword_confirmation" required autocomplete="new-password"
                                   placeholder="Re-enter your password">
                        </div>

                        <!-- Register Button -->
                        <div class="form-group">
                            <button type="submit" class="btn-register">
                                <i class="fas fa-user-plus"></i> Register Account
                            </button>
                        </div>

                        <div class="text-muted">
                            <i class="fas fa-info-circle"></i> By registering, you agree to our terms and conditions.
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('partials.responsive-overrides')
