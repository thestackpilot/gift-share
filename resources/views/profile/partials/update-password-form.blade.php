<section>
    <header class="mb-4">
        <h5 class="fw-semibold">Update Password</h5>
        <p class="text-muted small mb-0">Ensure your account is using a long, random password to stay secure.</p>
    </header>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="update_password_current_password" class="form-label">Current Password</label>
            <input type="password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" 
                   id="update_password_current_password" name="current_password">
            @error('current_password', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="update_password_password" class="form-label">New Password</label>
            <input type="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" 
                   id="update_password_password" name="password">
            @error('password', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="update_password_password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" 
                   id="update_password_password_confirmation" name="password_confirmation">
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary">Save</button>

            @if (session('status') === 'password-updated')
                <p class="text-success small mb-0">Saved.</p>
            @endif
        </div>
    </form>
</section>
