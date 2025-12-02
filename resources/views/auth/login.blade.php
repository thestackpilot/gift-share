<x-guest-layout>
    <h4 class="text-center mb-4 fw-semibold">Welcome Back</h4>
    
    <!-- Session Status -->
    <x-auth-session-status class="mb-3" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
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

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                   id="password" name="password" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
            <label class="form-check-label" for="remember_me">Remember me</label>
        </div>

        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-primary">Log in</button>
        </div>

        <div class="text-center">
            @if (Route::has('password.request'))
                <a class="text-decoration-none small" href="{{ route('password.request') }}">
                    Forgot your password?
                </a>
            @endif
        </div>
    </form>

    <hr class="my-4">

    <p class="text-center text-muted small mb-0">
        Don't have an account? 
        <a href="{{ route('register') }}" class="text-decoration-none">Sign up</a>
    </p>
</x-guest-layout>
