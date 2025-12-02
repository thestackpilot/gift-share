<x-guest-layout>
    <h4 class="text-center mb-3 fw-semibold">Forgot Password</h4>
    
    <p class="text-muted text-center small mb-4">
        Enter your email and we'll send you a password reset link.
    </p>

    <!-- Session Status -->
    <x-auth-session-status class="mb-3" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                   id="email" name="email" value="{{ old('email') }}" required autofocus>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Email Password Reset Link</button>
        </div>
    </form>

    <hr class="my-4">

    <p class="text-center text-muted small mb-0">
        <a href="{{ route('login') }}" class="text-decoration-none">Back to login</a>
    </p>
</x-guest-layout>
