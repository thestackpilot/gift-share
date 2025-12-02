<x-guest-layout>
    <h4 class="text-center mb-3 fw-semibold">Confirm Password</h4>
    
    <p class="text-muted text-center small mb-4">
        This is a secure area. Please confirm your password before continuing.
    </p>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                   id="password" name="password" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Confirm</button>
        </div>
    </form>
</x-guest-layout>
