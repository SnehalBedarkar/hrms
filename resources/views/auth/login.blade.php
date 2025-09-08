@extends('layouts.auth')

@section('content')
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-header bg-primary text-white text-center">
                <h4 class="mb-0">Login</h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('login.submit') }}" method="POST">
                    @csrf

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input 
                            type="email" 
                            name="email" 
                            id="email"
                            value="{{ old('email') }}"
                            class="form-control @error('email') is-invalid @enderror"
                            placeholder="Enter your email">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input 
                            type="password" 
                            name="password" 
                            id="password" 
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="Enter your password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-sign-in-alt me-2"></i> Login
                        </button>
                    </div>
                </form>
            </div>

            <div class="card-footer text-center small text-muted">
                &copy; {{ date('Y') }} Your Company. All rights reserved.
            </div>
        </div>
    </div>
</div>
@endsection
